<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateAutoDiscountResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateAutoDiscountResponses extends BaseViewResponses implements UpdateAutoDiscountResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.auto-discounts.index');
    }
}
