<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListInventoryResponseContract;
use App\Http\Resources\Backoffice\InventoryResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListInventoryResponse extends BaseResponse implements ListInventoryResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(InventoryResource::pagination($this->resource));
    }
}
