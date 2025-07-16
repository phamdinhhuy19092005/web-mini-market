<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StorePaymentProviderResponseContract;
use App\Http\Responses\BaseViewResponses;

class StorePaymentProviderResponses extends BaseViewResponses implements StorePaymentProviderResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.payment-providers.index');
    }
}
