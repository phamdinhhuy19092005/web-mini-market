<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateShippingZoneResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateShippingZoneResponses extends BaseViewResponses implements UpdateShippingZoneResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.shipping-zones.index');
    }
}
