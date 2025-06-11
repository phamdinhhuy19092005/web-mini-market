<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListCountryResponseContract;
use App\Http\Resources\CountryResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListCountryResponse extends BaseResponse implements ListCountryResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(CountryResource::pagination($this->resource));
    }
}
