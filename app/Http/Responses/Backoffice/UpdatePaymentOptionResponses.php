<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdatePaymentOptionResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdatePaymentOptionResponses extends BaseViewResponses implements UpdatePaymentOptionResponseContract
{

    public function toResponse($request)
    {
        return redirect()->route('bo.web.payment-options.index');
    }
}
