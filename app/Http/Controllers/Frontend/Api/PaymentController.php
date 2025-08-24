<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Coupon;
use App\Enum\DiscountTypeEnum;
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
            'cart_items' => 'required|array|min:1',
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'coupon_code' => 'nullable|string',
        ]);

        $amount = $this->calculateTotal($request->cart_items, $request->coupon_code);

        $orderInfo = [
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'cart_items' => $request->cart_items,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'coupon_code' => $request->coupon_code ?? null,
        ];

        $vnpUrl = $this->generateVnpayUrl($orderInfo, $amount);

        return response()->json(['url' => $vnpUrl]);
    }

    public function paymentReturn(Request $request)
    {
        $vnpOrderInfo = json_decode($request->query('vnp_OrderInfo'), true);
        $responseCode = $request->query('vnp_ResponseCode');
        $amount = $request->query('vnp_Amount');

        if ($responseCode !== '00') {
            return response()->json(['success' => false, 'message' => 'Thanh toán thất bại']);
        }

        try {
            $order = DB::transaction(function () use ($vnpOrderInfo, $amount) {
                return $this->orderService->createUserWithCoupon([
                    'user_id' => auth('sanctum')->id(),
                    'fullname' => $vnpOrderInfo['fullname'],
                    'phone' => $vnpOrderInfo['phone'],
                    'email' => $vnpOrderInfo['email'],
                    'cart_items' => $vnpOrderInfo['cart_items'],
                    'coupon_code' => $vnpOrderInfo['coupon_code'] ?? null,
                    'payment_option_id' => $vnpOrderInfo['payment_option_id'],
                    'shipping_option_id' => $vnpOrderInfo['shipping_option_id'],
                    'province_code' => $vnpOrderInfo['province_code'],
                    'district_code' => $vnpOrderInfo['district_code'],
                    'ward_code' => $vnpOrderInfo['ward_code'],
                    'address_line' => $vnpOrderInfo['address_line'],
                    'total_price' => $amount / 100,
                    'grand_total' => $amount / 100,
                    'order_status' => 1,
                    'payment_status' => 'paid',
                ]);
            });

            return response()->json(['success' => true, 'data' => $order]);
        } catch (\Exception $e) {
            Log::error('Tạo order sau VNPAY thất bại: '.$e->getMessage(), ['vnp_OrderInfo' => $vnpOrderInfo]);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    protected function calculateTotal(array $cartItems, ?string $couponCode = null): int
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $inventory = \App\Models\Inventory::find($item['inventory_id']);
            $price = $inventory->sale_price ?? $inventory->offer_price ?? $inventory->final_price;
            $total += $price * $item['quantity'];
        }

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon) {
                $discount = $coupon->type === DiscountTypeEnum::PERCENTAGE->value
                    ? $total * ($coupon->value / 100)
                    : $coupon->value;
                $total -= $discount;
            }
        }

        return $total * 100; // VNPAY test amount phải *100
    }

    protected function generateVnpayUrl(array $orderInfo, int $amount): string
    {
        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.payment_url');
        $vnp_ReturnUrl = config('services.vnpay.return_url');


        $vnp_TxnRef = $orderInfo['uuid'];
        $vnp_OrderInfo = json_encode($orderInfo);
        $vnp_Amount = $amount;
        $vnp_Command = "pay";
        $vnp_Locale = "vn";
        $vnp_CurrCode = "VND";

        $query = http_build_query([
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => $vnp_Command,
            'vnp_TxnRef' => $vnp_TxnRef,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_Locale' => $vnp_Locale,
            'vnp_CurrCode' => $vnp_CurrCode,
            'vnp_ReturnUrl' => $vnp_ReturnUrl,
            'vnp_CreateDate' => now()->format('YmdHis'),
        ]);

        $hash = hash_hmac('sha512', $query, $vnp_HashSecret);
        return $vnp_Url . '?' . $query . '&vnp_SecureHash=' . $hash;
    }
}
