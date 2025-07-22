<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListAutoDiscountResponseContract;
use App\Http\Resources\Backoffice\AutoDiscountResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListAutoDiscountResponse extends BaseResponse implements ListAutoDiscountResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(AutoDiscountResource::pagination($this->resource));
    }
}
