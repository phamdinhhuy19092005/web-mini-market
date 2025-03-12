<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCategoryGroupResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateBannerResponses extends BaseViewResponses implements UpdateBannerResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.banners.index');
    }
}
