<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListOrderResponseContract;
use App\Enum\DepositStatusEnum;
use App\Enum\OrderStatusEnum;
use App\Enum\PaymentOptionTypeEnum;
use App\Enum\PaymentStatusEnum;
use App\Mail\OrderCreatedMail;
use App\Models\Coupon;
use App\Models\Order;
use App\Services\DepositService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends BaseApiController
{

    public function __construct(protected OrderService $orderService, protected DepositService $depositService)
    {

    }

    public function index(Request $request)
    {
        $orders = $this->orderService->searchByAdmin($request->all());
        return $this->responses(ListOrderResponseContract::class, $orders);
    }

    public function userOrders($userId)
    {
        $orders = $this->orderService->getOrderWithItemsByUserId($userId);

        return $this->responses(ListOrderResponseContract::class, $orders);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $order = $this->orderService->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Tạo đơn hàng thành công',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tạo đơn hàng',
            ], 500);
        }
    }

    public function statisticOrderStatus(Request $request, $orderStatus)
    {
        $count = $this->orderService->statisticOrderStatus($orderStatus, $request->all());
        return response()->json(['count' => $count]);
    }

    public function items($orderId)
    {
        $order = $this->orderService->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order->items);
    }

    public function createDeposit($orderId)
    {
        $order = $this->orderService->find($orderId);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        if ($order->deposit_transaction_id) {
            return response()->json(['success' => false, 'message' => 'Deposit đã tồn tại']);
        }

        Log::info('DEBUG createDeposit', [
            'order_id' => $order->id,
            'order_payment_option_id' => $order->payment_option_id,
            'order_paymentOption_object' => $order->paymentOption,
        ]);

        $deposit = $this->depositService->deposit(
            $order->user,
            $order->grand_total,
            $order->paymentOption,
            ['order_id' => $order->id]
        );

        $order->deposit_transaction_id = $deposit->getKey();
        $order->payment_status = $this->parseDepositStatusToOrderPaymentStatus($deposit->status);
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Deposit đã được tạo',
            'deposit_id' => $deposit->getKey(),
        ]);
    }

    protected function parseDepositStatusToOrderPaymentStatus(int $depositStatus): int
    {
        return match ($depositStatus) {
            DepositStatusEnum::PENDING,
            DepositStatusEnum::WAIT_FOR_CONFIRMATION => PaymentStatusEnum::PENDING,
            DepositStatusEnum::APPROVED => PaymentStatusEnum::APPROVED,
            DepositStatusEnum::DECLINED => PaymentStatusEnum::DECLINED,
            DepositStatusEnum::FAILED => PaymentStatusEnum::FAILED,
            DepositStatusEnum::CANCELED => PaymentStatusEnum::CANCELED,

            default => PaymentStatusEnum::PENDING,
        };
    }

    // ==============================
    // Thêm các hành động thay đổi trạng thái
    // ==============================

    public function delivery($orderId)
    {
        $order = $this->orderService->find($orderId);

        Log::debug('Trạng thái đơn hàng:', ['order_id' => $order->id, 'status' => $order->order_status]);


        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }

        if (!$order->canDelivery()) {
            return response()->json(['message' => 'Không thể chuyển đơn hàng này'], 403);
        }

        $this->orderService->updateStatus($order, 'delivery', [
            'shipping_date' => now(),
            'delivery_date' => now(),
        ]);

        return response()->json(['message' => 'Đơn hàng đã được chuyển trạng thái vận chuyển']);
    }


    public function complete($orderId)
    {
        try {
            $order = $this->orderService->find($orderId);
            Log::debug('DEBUG: order loaded', ['order' => $order]);

            if (!$order) {
                Log::warning('Order not found', ['order_id' => $orderId]);
                return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
            }

            $order->load('paymentOption');
            Log::debug('DEBUG: paymentOption loaded', ['paymentOption' => $order->paymentOption]);

            if (!$order->canComplete()) {
                Log::warning('Order cannot complete', ['order_id' => $order->id, 'order_status' => $order->order_status]);
                return response()->json(['message' => 'Không thể hoàn thành đơn hàng này'], 403);
            }

            $this->orderService->updateStatus($order, 'complete');
            $order->refresh();
            Log::debug('DEBUG: order status updated', ['order_status' => $order->order_status]);

            $paymentType = (int) data_get($order->paymentOption, 'type');
            Log::debug('DEBUG: paymentType', ['paymentType' => $paymentType]);

            $deposit = $order->depositTransaction;
            if (!$deposit && PaymentOptionTypeEnum::isNoneAmount($paymentType)) {
                Log::debug('DEBUG: creating new deposit', ['order_id' => $order->id]);

                $deposit = $this->depositService->deposit(
                    $order->user,
                    $order->grand_total,
                    $order->paymentOption,
                    ['order_id' => $order->id]
                );
            }

            // Nếu là COD thì luôn đảm bảo deposit APPROVED
            if ($deposit && PaymentOptionTypeEnum::isNoneAmount($paymentType)) {
                $deposit->status = DepositStatusEnum::APPROVED;
                $deposit->save();
                Log::debug('DEBUG: deposit status updated', ['deposit_status' => $deposit->status]);

                // Cập nhật order
                $order->deposit_transaction_id = $deposit->getKey();
                $order->payment_status = $this->parseDepositStatusToOrderPaymentStatus($deposit->status);
                $order->save();
                Log::debug('DEBUG: order updated with deposit', [
                    'deposit_transaction_id' => $order->deposit_transaction_id,
                    'payment_status' => $order->payment_status
                ]);
            }

            Log::debug('DEBUG COMPLETE FLOW END', ['order_id' => $order->id]);

            DB::afterCommit(function () use ($order) {
                try {
                    Mail::to($order->user->email)
                        ->send(new OrderCreatedMail($order));
                    Log::info('Order completed mail queued', ['order_id' => $order->id]);
                } catch (\Exception $e) {
                    Log::error('Failed to queue order completed mail', [
                        'order_id' => $order->id,
                        'message' => $e->getMessage()
                    ]);
                }
            });

            return response()->json(['message' => 'Đơn hàng đã được hoàn thành và deposit đã xử lý nếu là COD']);
        } catch (\Exception $e) {
            Log::error('Error in complete method', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Có lỗi xảy ra khi hoàn thành đơn hàng'], 500);
        }
    }

    public function refund($orderId)
    {
        $order = $this->orderService->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }

        if (!$order->canRefund()) {
            return response()->json(['message' => 'Không thể hoàn tiền đơn hàng này'], 403);
        }

        $this->orderService->updateStatus($order, 'refund');

        return response()->json(['message' => 'Đơn hàng đã được hoàn tiền']);
    }

    public function cancel($orderId)
    {
        $order = $this->orderService->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }

        if (!$order->canCancel()) {
            return response()->json(['message' => 'Không thể hủy đơn hàng này'], 403);
        }

        $this->orderService->updateStatus($order, 'cancel');

        return response()->json(['message' => 'Đơn hàng đã bị hủy']);
    }

    public function updateToProcessing($orderId)
    {
        $order = $this->orderService->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }

        if ($order->order_status !== OrderStatusEnum::WAITING_FOR_PAYMENT) {
            return response()->json(['message' => 'Không thể chuyển đơn hàng này sang Đang xử lí'], 403);
        }

        $this->orderService->updateStatus($order, 'processing');

        return response()->json([
            'success' => true,
            'order_status' => $order->order_status,
            'message' => 'Đơn hàng đã được chuyển sang trạng thái Đang xử lí'
        ]);
    }

    public function statistics()
    {
        // Lấy số lượng đơn hàng theo ngày trong 7 ngày gần nhất
        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($orders);
    }

    public function applyCoupon(Request $request, $orderId)
    {
        $order = $this->orderService->find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        $code = $request->input('code');
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Coupon không hợp lệ'], 404);
        }

        // Kiểm tra ngày sử dụng
        $now = now();
        if (($coupon->start_date && $coupon->start_date > $now) ||
            ($coupon->end_date && $coupon->end_date < $now)) {
            return response()->json(['success' => false, 'message' => 'Coupon chưa đến hạn sử dụng hoặc đã hết hạn'], 400);
        }

        // Kiểm tra số lần sử dụng
        if ($coupon->usage_limit && $coupon->used >= $coupon->usage_limit) {
            return response()->json(['success' => false, 'message' => 'Coupon đã đạt giới hạn sử dụng'], 400);
        }

        // Tính toán giảm giá
        if ($coupon->discount_type === 'percent') {
            $discountAmount = $order->total_price * ($coupon->discount_value / 100);
        } else {
            $discountAmount = $coupon->discount_value;
        }

        // Lưu thông tin coupon và tổng tiền giảm giá
        $order->coupon_id = $coupon->id;
        $order->discount_amount = $discountAmount;
        $order->grand_total = $order->total_price - $discountAmount;
        $order->save();

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'coupon' => $coupon,
            'discount_amount' => $discountAmount,
            'grand_total' => $order->grand_total,
        ]);
    }
}
