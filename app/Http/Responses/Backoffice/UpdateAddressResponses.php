<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateAddressResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateAddressResponses extends BaseViewResponses implements UpdateAddressResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.addresses.index');
    }
}
