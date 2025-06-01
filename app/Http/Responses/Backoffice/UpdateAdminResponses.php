<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateAdminResponses extends BaseViewResponses implements UpdateBannerResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.admins.index');
    }
}
