<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enum\OrderStatusEnum;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): JsonResponse
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ], 401);
        }

        $perPage = $request->get('per_page', 10);
        $orders = $this->orderService->create($user->id, $perPage);

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $order = $this->orderService->createUser($data);

            return response()->json([
                'success' => true,
                'message' => 'Tạo đơn hàng thành công',
                'data' => $order->fresh(),
            ], 201);
        } catch (\Exception $e) {
            Log::error('Tạo đơn hàng thất bại: '.$e->getMessage(), ['data' => $data]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function show($uuid): JsonResponse
    {
        $order = Order::where('uuid', $uuid)->first();

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
