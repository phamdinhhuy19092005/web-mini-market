<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListRoleResponseContract;
use App\Http\Resources\RoleResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListRoleResponse extends BaseResponse implements ListRoleResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(RoleResource::pagination($this->resource));
    }
}
