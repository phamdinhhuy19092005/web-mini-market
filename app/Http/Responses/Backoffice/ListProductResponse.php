<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListProductResponseContract;
use App\Http\Resources\Backoffice\ProductResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListProductResponse extends BaseResponse implements ListProductResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(ProductResource::pagination($this->resource));
    }
}
