<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListPageResponseContract;
use App\Http\Resources\PageResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListPageResponse extends BaseResponse implements ListPageResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(PageResource::pagination($this->resource));
    }
}
