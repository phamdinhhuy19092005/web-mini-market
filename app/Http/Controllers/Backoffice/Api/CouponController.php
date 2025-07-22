<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCouponResponseContract;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends BaseApiController
{
    public function __construct(protected CouponService $couponService)
    {
    }

    public function index(Request $request)
    {
        $coupons = $this->couponService->searchByAdmin($request->all());
        
        return $this->responses(ListCouponResponseContract::class, $coupons);
    }
}
