<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreShippingRateResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreShippingRateResponses extends BaseViewResponses implements StoreShippingRateResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.shipping-rates.index');
    }
}
