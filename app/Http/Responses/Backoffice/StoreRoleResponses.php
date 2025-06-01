<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreRoleResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreRoleResponses extends BaseViewResponses implements StoreRoleResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.roles.index');
    }
}
