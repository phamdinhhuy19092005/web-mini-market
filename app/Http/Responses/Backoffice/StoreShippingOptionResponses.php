<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreShippingOptionResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreShippingOptionResponses extends BaseViewResponses implements StoreShippingOptionResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.shipping-options.index');
    }
}
