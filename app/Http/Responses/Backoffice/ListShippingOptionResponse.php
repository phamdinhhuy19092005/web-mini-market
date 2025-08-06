<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListShippingOptionResponseContract;
use App\Http\Resources\Backoffice\ShippingOptionResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListShippingOptionResponse extends BaseResponse implements ListShippingOptionResponseContract
{
    public function toResponse($request)
    {

        return new JsonResponse(ShippingOptionResource::pagination($this->resource));
    }
}
