<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListAttributeResponseContract;
use App\Http\Resources\Backoffice\AttributeResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListAttributeResponse extends BaseResponse implements ListAttributeResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(AttributeResource::pagination($this->resource));
    }
}
