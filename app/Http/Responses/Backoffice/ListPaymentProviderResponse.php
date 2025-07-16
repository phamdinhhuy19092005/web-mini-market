<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListPaymentProviderResponseContract;
use App\Http\Resources\Backoffice\CategoryResource;
use App\Http\Resources\Backoffice\PaymentProviderResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListPaymentProviderResponse extends BaseResponse implements ListPaymentProviderResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(PaymentProviderResource::pagination($this->resource));
    }
}
