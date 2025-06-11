<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListCurrencyResponseContract;
use App\Http\Resources\CurrencyResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListCurrencyResponse extends BaseResponse implements ListCurrencyResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(CurrencyResource::pagination($this->resource));
    }
}
