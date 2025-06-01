<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreBannerResponses extends BaseViewResponses implements StoreBannerResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.banners.index');
    }
}
