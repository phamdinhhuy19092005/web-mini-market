<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Enum\DiscountTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Http\Resources\Frontend\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createSession(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'cart_items' => 'required|array|min:1',
            'cart_items.*.inventory_id' => 'required|integer|exists:inventories,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'province_code' => 'required|string|max:50|exists:provinces,code',
            'district_code' => 'nullable|string|max:50',
            'ward_code' => 'nullable|string|max:50',
            'address_line' => 'nullable|string|max:255',
            'user_note' => 'nullable|string|max:500',
            'admin_note' => 'nullable|string|max:500',
            'shipping_option_id' => 'nullable|integer|exists:shipping_options,id',
            'payment_option_id' => 'required|integer|exists:payment_options,id',
            'coupon_code' => 'nullable|string|max:50',
            'order_channel' => 'nullable|array',
            'order_channel.type' => 'nullable|string|in:online,offline',
            'order_channel.reference_id' => 'nullable|string|max:255',
        ]);

        try {
            $amount = $this->calculateTotal($request->cart_items, $request->coupon_code);

            Log::info('Tổng tiền tính được cho đơn hàng', [
                'amount' => $amount,
                'cart_items' => $request->cart_items,
                'coupon_code' => $request->coupon_code,
            ]);

            $orderInfo = [
                'uuid' => (string) \Illuminate\Support\Str::uuid(),
                'user_id' => $request->user_id,
                'cart_items' => $request->cart_items,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'company' => $request->company,
                'province_code' => $request->province_code,
                'district_code' => $request->district_code,
                'ward_code' => $request->ward_code,
                'address_line' => $request->address_line,
                'user_note' => $request->user_note,
                'admin_note' => $request->admin_note,
                'shipping_option_id' => $request->shipping_option_id,
                'payment_option_id' => $request->payment_option_id,
                'coupon_code' => $request->coupon_code ?? null,
                'order_channel' => $request->order_channel ?? ['type' => 'online', 'reference_id' => null],
            ];

            \Illuminate\Support\Facades\Cache::put('order_' . $orderInfo['uuid'], $orderInfo, now()->addHours(2));

            Log::info('VNPAY createSession input', [
                'order_info' => $orderInfo,
                'amount' => $amount,
            ]);

            $vnpUrl = $this->generateVnpayUrl($orderInfo, $amount, $request->ip());

            Log::info('VNPAY URL đã tạo', ['url' => $vnpUrl, 'orderInfo' => $orderInfo]);

            return response()->json(['url' => $vnpUrl]);
        } catch (\Exception $e) {
            Log::error('Lỗi tạo session VNPAY: ' . $e->getMessage(), [
                'request' => $request->all(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['success' => false, 'message' => 'Lỗi tạo session thanh toán: ' . $e->getMessage()], 500);
        }
    }

    public function paymentReturn(Request $request)
    {
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_SecureHash = $request->query('vnp_SecureHash');
        $inputData = $request->query();
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);
        $query = http_build_query($inputData, '', '&', PHP_QUERY_RFC1738);
        $calculatedHash = hash_hmac('sha512', $query, $vnp_HashSecret);

        if ($calculatedHash !== $vnp_SecureHash) {
            Log::error('VNPAY Secure Hash không khớp', [
                'calculated' => $calculatedHash,
                'received' => $vnp_SecureHash,
                'query' => $request->query(),
                'query_string' => $query,
            ]);
            return response()->json(['success' => false, 'message' => 'Secure Hash không hợp lệ'], 400);
        }

        $txnRef = $request->query('vnp_TxnRef');
        $responseCode = $request->query('vnp_ResponseCode');
        $amount = $request->query('vnp_Amount');

        $orderInfo = \Illuminate\Support\Facades\Cache::get('order_' . $txnRef);
        if (!$orderInfo) {
            Log::error('Không tìm thấy thông tin đơn hàng trong cache', [
                'txnRef' => $txnRef,
                'cache_key' => 'order_' . $txnRef,
            ]);
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin đơn hàng'], 400);
        }

        Log::info('VNPAY callback received', [
            'vnp_OrderInfo' => $request->query('vnp_OrderInfo'),
            'vnp_ResponseCode' => $responseCode,
            'vnp_Amount' => $amount,
            'vnp_TxnRef' => $txnRef,
            'all_query' => $request->query(),
            'orderInfo' => $orderInfo,
        ]);

        try {
            $orderData = [
                'user_id' => $orderInfo['user_id'],
                'cart_items' => $orderInfo['cart_items'] ?? [],
                'fullname' => $orderInfo['fullname'] ?? null,
                'phone' => $orderInfo['phone'] ?? null,
                'email' => $orderInfo['email'] ?? null,
                'company' => $orderInfo['company'] ?? null,
                'province_code' => $orderInfo['province_code'] ?? null,
                'district_code' => $orderInfo['district_code'] ?? null,
                'ward_code' => $orderInfo['ward_code'] ?? null,
                'address_line' => $orderInfo['address_line'] ?? null,
                'user_note' => $orderInfo['user_note'] ?? null,
                'admin_note' => $orderInfo['admin_note'] ?? null,
                'shipping_option_id' => $orderInfo['shipping_option_id'] ?? null,
                'payment_option_id' => $orderInfo['payment_option_id'] ?? null,
                'coupon_code' => $orderInfo['coupon_code'] ?? null,
                'order_channel' => $orderInfo['order_channel'] ?? ['type' => 'online', 'reference_id' => null],
                'total_price' => $amount / 100,
                'grand_total' => $amount / 100,
                'order_status' => $responseCode === '00' ? OrderStatusEnum::PROCESSING : OrderStatusEnum::CANCELED,
                'payment_status' => $responseCode === '00' ? 'paid' : 'failed',
            ];

            Log::info('Dữ liệu gửi đến OrderService', ['orderData' => $orderData]);

            $order = DB::transaction(function () use ($orderData) {
                return $this->orderService->createOrderUserWithCoupon($orderData);
            });

            \Illuminate\Support\Facades\Cache::forget('order_' . $txnRef);

            Log::info('Đơn hàng được tạo thành công', ['order' => $order->toArray()]);

            return response()->json(['success' => $responseCode === '00', 'data' => new OrderResource($order)]);
        } catch (\Exception $e) {
            Log::error('Tạo order sau VNPAY thất bại: ' . $e->getMessage(), [
                'orderInfo' => $orderInfo,
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json(['success' => false, 'message' => 'Lỗi tạo đơn hàng: ' . $e->getMessage()], 500);
        }
    }

    protected function calculateTotal(array $cartItems, ?string $couponCode = null): int
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $inventory = \App\Models\Inventory::find($item['inventory_id']);
            if (!$inventory) {
                Log::error('Không tìm thấy sản phẩm trong kho', ['inventory_id' => $item['inventory_id']]);
                throw new \Exception('Sản phẩm không tồn tại: ' . $item['inventory_id']);
            }
            $price = $inventory->sale_price ?? $inventory->offer_price ?? $inventory->final_price ?? 0;
            if ($price === 0) {
                Log::warning('Giá sản phẩm bằng 0', ['inventory_id' => $item['inventory_id']]);
            }
            $total += $price * $item['quantity'];
        }

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon) {
                $discount = $coupon->type === DiscountTypeEnum::PERCENTAGE->value
                    ? $total * ($coupon->value / 100)
                    : $coupon->value;
                $total = max(0, $total - $discount);
            } else {
                Log::warning('Mã coupon không hợp lệ', ['coupon_code' => $couponCode]);
            }
        }

        return $total * 100;
    }

    protected function generateVnpayUrl(array $orderInfo, int $amount, string $ipAddr): string
    {
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');
        $vnp_Url = config('vnpay.url');
        $vnp_ReturnUrl = config('vnpay.return_url');

        $vnp_TxnRef = $orderInfo['uuid'];
        $vnp_OrderInfo = "Thanh toán đơn hàng {$orderInfo['uuid']}";
        $vnp_Amount = $amount;
        $vnp_Command = config('vnpay.command');
        $vnp_Locale = config('vnpay.locale');
        $vnp_CurrCode = config('vnpay.currency');

        $inputData = [
            'vnp_Version' => config('vnpay.version'),
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => $vnp_Command,
            'vnp_TxnRef' => $vnp_TxnRef,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_Locale' => $vnp_Locale,
            'vnp_CurrCode' => $vnp_CurrCode,
            'vnp_ReturnUrl' => $vnp_ReturnUrl,
            'vnp_CreateDate' => now()->format('YmdHis'),
            'vnp_ExpireDate' => now()->addMinutes(15)->format('YmdHis'),
            'vnp_IpAddr' => $ipAddr,
            'vnp_OrderType' => 'topup',
        ];

        ksort($inputData);
        $query = http_build_query($inputData, '', '&', PHP_QUERY_RFC1738);
        $hash = hash_hmac('sha512', $query, $vnp_HashSecret);

        return $vnp_Url . '?' . $query . '&vnp_SecureHash=' . $hash;
    }
}
