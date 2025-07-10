<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListShippingZoneResponseContract;
use App\Http\Resources\Backoffice\ShippingRateResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListShippingZoneResponse extends BaseResponse implements ListShippingZoneResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(ShippingRateResource::pagination($this->resource));
    }
}
