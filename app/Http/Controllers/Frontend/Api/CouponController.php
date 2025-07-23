<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(protected CouponService $couponService)
    {
    }

    public function index(Request $request)
    {
        $coupons = $this->couponService->searchByFrontend($request->all());

        return response()->json([
            'success' => true,
            'data' => $coupons
        ]);
    }
}
