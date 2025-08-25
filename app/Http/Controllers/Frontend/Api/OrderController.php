<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enum\OrderStatusEnum;
use App\Http\Resources\Frontend\OrderResource;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected OrderService $orderService;
    protected CartService $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }

    public function index(Request $request): JsonResponse
    {
        $user = auth('sanctum')->user();

        $status = $request->query('order_status');

        $ordersQuery = Order::with([
            'orderItems.inventory.product'
        ])->where('user_id', $user->id);

        if ($status) {
            $ordersQuery->where('order_status', $status);
        }

        $orders = $ordersQuery->latest()->get();

        return response()->json([
            'success' => true,
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User không hợp lệ'], 401);
            }

            $data = $request->all();
            $data['user_id'] = $user->id;

            // Tạo đơn hàng
            $order = $this->orderService->createOrderUserWithCoupon($data);

            // Xóa giỏ hàng cũ
            $cart = $this->cartService->getOrCreateCart($user, null, request()->ip());
            $this->cartService->clearCart($cart);

            return response()->json([
                'success' => true,
                'message' => 'Tạo đơn hàng thành công',
                'data' => $order,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Tạo đơn hàng thất bại: '.$e->getMessage(), ['data' => $request->all()]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }


    public function show($uuid): JsonResponse
    {
        $order = Order::with([
            'orderItems.inventory',
            'paymentOption',
            'shippingRate',
            'coupon'
        ])
        ->where('uuid', $uuid)
        ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    public function cancel($uuid): JsonResponse
    {
        try {
            $order = Order::where('uuid', $uuid)->firstOrFail();

            $order->update(['order_status' => OrderStatusEnum::CANCELED]);

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã bị hủy',
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function applyCoupon(Request $request, $uuid): JsonResponse
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $order = Order::where('uuid', $uuid)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng',
            ], 404);
        }

        try {
            $couponCode = $request->input('coupon_code');

            // Gọi service để áp dụng coupon
            $updatedOrder = $this->orderService->applyCoupon($order->id, $couponCode);

            return response()->json([
                'success' => true,
                'message' => 'Áp dụng mã giảm giá thành công',
                'data' => $updatedOrder
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }


}
