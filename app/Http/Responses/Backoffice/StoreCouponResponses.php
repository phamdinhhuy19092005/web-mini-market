<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCouponResponseContract;
use App\Http\Responses\BaseViewResponses;

class StoreCouponResponses extends BaseViewResponses implements StoreCouponResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('bo.web.coupons.index');
    }
}
