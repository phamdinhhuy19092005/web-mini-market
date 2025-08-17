<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListOrderItemResponseContract;
use App\Services\OrderItemService;
use Illuminate\Http\Request;

class OrderItemController extends BaseApiController
{
    public function __construct(protected OrderItemService $orderItemService)
    {
    }

    public function index(Request $request)
    {
        $order_items = $this->orderItemService->searchByAdmin($request->all());
        
        return $this->responses(ListOrderItemResponseContract::class, $order_items);
    }


    
}
