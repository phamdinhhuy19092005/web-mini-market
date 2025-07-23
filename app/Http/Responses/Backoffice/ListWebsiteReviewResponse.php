<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListWebsiteReviewResponseContract;
use App\Http\Resources\Backoffice\WebsiteReviewResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListWebsiteReviewResponse extends BaseResponse implements ListWebsiteReviewResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(WebsiteReviewResource::pagination($this->resource));
    }
}
