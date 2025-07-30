<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAddressResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreAddressResponses extends BaseViewResponses implements StoreAddressResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.addresses.index');
    }
}
