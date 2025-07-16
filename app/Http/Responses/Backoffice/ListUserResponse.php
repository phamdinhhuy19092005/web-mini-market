<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListUserResponseContract;
use App\Http\Resources\Backoffice\UserResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListUserResponse extends BaseResponse implements ListUserResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(UserResource::pagination($this->resource));
    }
}
