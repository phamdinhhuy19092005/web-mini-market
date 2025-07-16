<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StorePaymentOptionResponseContract;
use App\Http\Responses\BaseViewResponses;

class StorePaymentOptionResponses extends BaseViewResponses implements StorePaymentOptionResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.payment-options.index');
    }
}
