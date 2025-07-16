<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdatePaymentProviderResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdatePaymentProviderResponses extends BaseViewResponses implements UpdatePaymentProviderResponseContract
{

    public function toResponse($request)
    {
        return redirect()->route('bo.web.payment-providers.index');
    }
}
