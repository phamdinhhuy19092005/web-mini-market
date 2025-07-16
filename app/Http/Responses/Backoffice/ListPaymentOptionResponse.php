<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListPaymentOptionResponseContract;
use App\Http\Resources\Backoffice\PaymentOptionResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListPaymentOptionResponse extends BaseResponse implements ListPaymentOptionResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(PaymentOptionResource::pagination($this->resource));
    }
}
