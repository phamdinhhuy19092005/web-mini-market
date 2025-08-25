<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Enum\DiscountTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Http\Resources\Frontend\OrderResource;
use App\Models\User;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected OrderService $orderService;
    protected CartService $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
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
            $amounts = $this->calculateTotal($request->cart_items, $request->coupon_code);
            $totalPrice = $amounts['total_price'];     
            $grandTotal = $amounts['grand_total'];     

            Log::info('Tổng tiền tính được cho đơn hàng', [
                'total_price' => $totalPrice,
                'grand_total' => $grandTotal,
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
                'total_price' => $totalPrice / 100,
                'grand_total' => $grandTotal / 100,
            ];

            Cache::put('order_' . $orderInfo['uuid'], $orderInfo, now()->addHours(2));

            Log::info('VNPAY createSession input', [
                'order_info' => $orderInfo,
                'amount' => $grandTotal,
            ]);

            $vnpUrl = $this->generateVnpayUrl($orderInfo, $grandTotal, $request->ip());

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
            Log::error('VNPAY Secure Hash không khớp', ['calculated' => $calculatedHash, 'received' => $vnp_SecureHash]);
            return redirect('http://localhost:3001/payment-result?status=error');
        }

        $txnRef = $request->query('vnp_TxnRef');
        $responseCode = $request->query('vnp_ResponseCode');

        $orderInfo = Cache::get('order_' . $txnRef);
        if (!$orderInfo) {
            Log::error('Không tìm thấy thông tin đơn hàng trong cache', ['txnRef' => $txnRef]);
            return redirect('http://localhost:3001/payment-result?status=error');
        }

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
                'total_price' => $orderInfo['total_price'],  // dùng total_price từ cache
                'grand_total' => $orderInfo['grand_total'],  // dùng grand_total từ cache
                'order_status' => $responseCode === '00' ? OrderStatusEnum::PROCESSING : OrderStatusEnum::CANCELED,
                'payment_status' => $responseCode === '00' ? 'paid' : 'failed',
            ];

            $order = DB::transaction(function () use ($orderData) {
                return $this->orderService->createOrderUserWithCoupon($orderData);
            });

            // Xóa giỏ hàng nếu thanh toán thành công
            if ($responseCode === '00') {
                $user = User::find($orderInfo['user_id']);
                if ($user) {
                    $cart = $this->cartService->getOrCreateCart($user, null, request()->ip());
                    $this->cartService->clearCart($cart);
                }
            }

            Cache::forget('order_' . $txnRef);

            // Redirect về frontend với trạng thái
            $status = $responseCode === '00' ? 'success' : 'fail';
            return redirect("http://localhost:3001/payment-result?status={$status}");
        } catch (\Exception $e) {
            Log::error('Tạo order sau VNPAY thất bại: ' . $e->getMessage(), ['orderInfo' => $orderInfo]);
            return redirect('http://localhost:3001/payment-result?status=error');
        }
    }

    protected function calculateTotal(array $cartItems, ?string $couponCode = null): array
    {
        $totalPrice = 0; 
        foreach ($cartItems as $item) {
            $inventory = \App\Models\Inventory::find($item['inventory_id']);
            if (!$inventory) {
                throw new \Exception('Sản phẩm không tồn tại: ' . $item['inventory_id']);
            }
            $price = $inventory->offer_price ?? $inventory->sale_price ?? 0;
            $totalPrice += $price * $item['quantity'];
        }

        $grandTotal = $totalPrice;
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon) {
                $discount = $coupon->type === DiscountTypeEnum::PERCENTAGE->value
                    ? $grandTotal * ($coupon->value / 100)
                    : $coupon->value;
                $grandTotal = max(0, $grandTotal - $discount);
            }
        }

        return [
            'total_price' => $totalPrice * 100, 
            'grand_total' => $grandTotal * 100,
        ];
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
