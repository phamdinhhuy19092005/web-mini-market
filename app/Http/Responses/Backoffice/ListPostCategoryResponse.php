<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListPostCategoryResponseContract;
use App\Http\Resources\PostCategoryResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListPostCategoryResponse extends BaseResponse implements ListPostCategoryResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(PostCategoryResource::pagination($this->resource));
    }
}
