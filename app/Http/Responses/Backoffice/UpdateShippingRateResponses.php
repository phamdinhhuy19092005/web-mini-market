<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateShippingRateResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateShippingRateResponses extends BaseViewResponses implements UpdateShippingRateResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.shipping-rates.index');
    }
}
