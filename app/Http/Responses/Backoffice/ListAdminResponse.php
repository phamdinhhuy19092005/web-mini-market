<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListAdminResponseContract;
use App\Http\Resources\AdminResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListAdminResponse extends BaseResponse implements ListAdminResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(AdminResource::pagination($this->resource));
    }
}
