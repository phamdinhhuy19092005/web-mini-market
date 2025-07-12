<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListPostResponseContract;
use App\Http\Resources\Backoffice\PostResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListPostResponse extends BaseResponse implements ListPostResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(PostResource::pagination($this->resource));
    }
}
