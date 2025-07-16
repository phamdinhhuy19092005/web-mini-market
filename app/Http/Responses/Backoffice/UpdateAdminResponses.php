<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateAdminResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateAdminResponses extends BaseViewResponses implements UpdateAdminResponseContract
{

    public function toResponse($request)
    {
        return redirect()->route('bo.web.admins.index');
    }
}
