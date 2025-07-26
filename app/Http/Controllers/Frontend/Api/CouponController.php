<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponController extends BaseController
{
    public function index(): JsonResponse
    {
        $coupons = Coupon::all();
        return $this->jsonResponse(true, CouponResource::collection($coupons));
    }

    public function show($id): JsonResponse
    {
        $coupon = Coupon::find($id);
        if (!$coupon) {
            return $this->jsonResponse(false, null, 'Mã giảm giá không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new CouponResource($coupon));
    }
}