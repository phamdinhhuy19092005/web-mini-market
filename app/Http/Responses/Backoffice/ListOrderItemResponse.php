<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListOrderItemResponseContract;
use App\Http\Resources\Backoffice\OrderItemResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListOrderItemResponse extends BaseResponse implements ListOrderItemResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(OrderItemResource::pagination($this->resource));
    }
}
