<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListCouponResponseContract;
use App\Http\Resources\Backoffice\CouponResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListCouponResponse extends BaseResponse implements ListCouponResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(CouponResource::pagination($this->resource));
    }
}
