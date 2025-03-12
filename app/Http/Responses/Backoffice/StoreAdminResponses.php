<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAdminResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreAdminResponses extends BaseViewResponses implements StoreAdminResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.admins.index');
    }
}
