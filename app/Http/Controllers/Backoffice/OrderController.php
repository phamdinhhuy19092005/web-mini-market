<?php

namespace App\Http\Controllers\Backoffice;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function __construct(public OrderService $orderService)
    {
    }

    public function create(Request $request)
    {
        $order = $this->orderService->orderByAdmin($request->all());

        return response()->json([
            'message' => 'Tạo đơn hàng thành công',
            'order' => $order,
        ]);
    }
}