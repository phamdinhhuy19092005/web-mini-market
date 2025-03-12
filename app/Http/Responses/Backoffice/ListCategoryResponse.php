<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListCategoryResponseContract;
use App\Http\Resources\CategoryResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListCategoryResponse extends BaseResponse implements ListCategoryResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(CategoryResource::pagination($this->resource));
    }
}
