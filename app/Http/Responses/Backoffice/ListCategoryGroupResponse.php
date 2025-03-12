<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListCategoryGroupResponseContract;
use App\Http\Resources\CategoryGroupResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListCategoryGroupResponse extends BaseResponse implements ListCategoryGroupResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(CategoryGroupResource::pagination($this->resource));
    }
}
