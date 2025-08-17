<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListOrderResponseContract;
use App\Enum\OrderStatusEnum;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends BaseApiController
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function index(Request $request)
    {
        $orders = $this->orderService->searchByAdmin($request->all());
        return $this->responses(ListOrderResponseContract::class, $orders);
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

        $this->orderService->updateStatus($order, 'delivery');

        return response()->json(['message' => 'Đơn hàng đã được chuyển trạng thái vận chuyển']);
    }


    public function complete($orderId)
    {
        $order = $this->orderService->find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }

        if (!$order->canComplete()) {
            return response()->json(['message' => 'Không thể hoàn thành đơn hàng này'], 403);
        }

        $this->orderService->updateStatus($order, 'complete');

        return response()->json(['message' => 'Đơn hàng đã được hoàn thành']);
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


}
