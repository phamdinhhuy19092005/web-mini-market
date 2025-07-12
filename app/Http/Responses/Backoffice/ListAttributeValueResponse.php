<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListAttributeValueResponseContract;
use App\Http\Resources\Backoffice\AttributeValueResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListAttributeValueResponse extends BaseResponse implements ListAttributeValueResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(AttributeValueResource::pagination($this->resource));
    }
}
