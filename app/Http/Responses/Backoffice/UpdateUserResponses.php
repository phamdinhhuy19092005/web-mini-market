<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateUserResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateUserResponses extends BaseViewResponses implements UpdateUserResponseContract
{

    public function toResponse($request)
    {
        return redirect()->route('bo.web.users.index');
    }
}
