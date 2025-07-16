<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreUserResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreUserResponses extends BaseViewResponses implements StoreUserResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.users.index');
    }
}
