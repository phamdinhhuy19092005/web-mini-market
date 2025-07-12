<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListSubCategoryResponseContract;
use App\Http\Resources\Backoffice\SubCategoryResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListSubCategoryResponse extends BaseResponse implements ListSubCategoryResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(SubCategoryResource::pagination($this->resource));
    }
}
