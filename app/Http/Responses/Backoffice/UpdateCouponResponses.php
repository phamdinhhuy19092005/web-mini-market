<?php

namespace App\Http\Responses\Backoffice;

use App\Contracts\Responses\Backoffice\UpdateCouponResponseContract;
use App\Http\Responses\BaseViewResponses;

class UpdateCouponResponses extends BaseViewResponses implements UpdateCouponResponseContract
{
    
    public function toResponse($request)
    {
        return redirect()->route('bo.web.coupons.index');
    }
}
