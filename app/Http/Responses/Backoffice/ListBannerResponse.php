<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\ListBannerResponseContract;
use App\Http\Resources\BannerResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Http\JsonResponse;

class ListBannerResponse extends BaseResponse implements ListBannerResponseContract
{
    public function toResponse($request)
    {
        return new JsonResponse(BannerResource::pagination($this->resource));
    }
}
