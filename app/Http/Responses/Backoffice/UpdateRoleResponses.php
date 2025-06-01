<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateRoleResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateRoleResponses extends BaseViewResponses implements UpdateRoleResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.roles.index');
    }
}
