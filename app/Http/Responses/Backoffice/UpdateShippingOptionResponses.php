<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateShippingOptionResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateShippingOptionResponses extends BaseViewResponses implements UpdateShippingOptionResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.shipping-options.index');
    }
}
