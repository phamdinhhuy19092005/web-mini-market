<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListSubscriberResponseContract;
use App\Http\Resources\Backoffice\SubscriberResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListSubscriberResponse extends BaseResponse implements ListSubscriberResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(SubscriberResource::pagination($this->resource));
    }
}
