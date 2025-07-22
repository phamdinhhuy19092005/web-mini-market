<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAutoDiscountResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreAutoDiscountResponses extends BaseViewResponses implements StoreAutoDiscountResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.auto-discounts.index');
    }
}
