<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreShippingZoneResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreShippingZoneResponses extends BaseViewResponses implements StoreShippingZoneResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.shipping-zones.index');
    }
}
