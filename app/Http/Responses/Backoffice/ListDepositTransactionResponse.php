<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListDepositTransactionResponseContract;
use App\Http\Resources\Backoffice\DepositTransactionResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListDepositTransactionResponse extends BaseResponse implements ListDepositTransactionResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(DepositTransactionResource::pagination($this->resource));
    }
}
