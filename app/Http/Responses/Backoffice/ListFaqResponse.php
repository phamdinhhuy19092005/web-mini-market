<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListFaqResponseContract;
use App\Http\Resources\Backoffice\FaqResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListFaqResponse extends BaseResponse implements ListFaqResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(FaqResource::pagination($this->resource));
    }
}
