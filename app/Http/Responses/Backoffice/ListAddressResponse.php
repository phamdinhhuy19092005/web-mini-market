<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListAddressResponseContract;
use App\Http\Resources\Backoffice\AddressResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListAddressResponse extends BaseResponse implements ListAddressResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(AddressResource::pagination($this->resource));
    }
}
