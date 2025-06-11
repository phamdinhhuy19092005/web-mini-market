<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListFaqTopicResponseContract;
use App\Http\Resources\FaqTopicResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListFaqTopicResponse extends BaseResponse implements ListFaqTopicResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(FaqTopicResource::pagination($this->resource));
    }
}
