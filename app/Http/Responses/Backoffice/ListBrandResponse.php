<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListBrandResponseContract;
use App\Http\Resources\Backoffice\BrandResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListBrandResponse extends BaseResponse implements ListBrandResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(BrandResource::pagination($this->resource));
    }
}
