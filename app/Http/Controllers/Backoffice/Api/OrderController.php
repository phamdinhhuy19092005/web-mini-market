<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListOrderResponseContract;
use App\Services\OrderService;
use Illuminate\Http\Request;

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
}