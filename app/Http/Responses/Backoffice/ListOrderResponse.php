<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListOrderResponseContract;
use App\Http\Resources\Backoffice\OrderResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListOrderResponse extends BaseResponse implements ListOrderResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(OrderResource::pagination($this->resource));
    }
}
