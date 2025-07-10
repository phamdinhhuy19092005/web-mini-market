<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListShippingRateResponseContract;
use App\Http\Resources\Backoffice\ShippingRateResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListShippingRateResponse extends BaseResponse implements ListShippingRateResponseContract
{
    public function toResponse($request)
    {

        return new JsonResponse(ShippingRateResource::pagination($this->resource));
    }
}
