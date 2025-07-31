<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListCartResponseContract;
use App\Http\Resources\Backoffice\CartResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListCartResponse extends BaseResponse implements ListCartResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(CartResource::pagination($this->resource));
    }
}
