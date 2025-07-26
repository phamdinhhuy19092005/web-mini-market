<?php

namespace App\Http\Controllers\Frontend\Api;

<<<<<<< HEAD
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
=======
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
>>>>>>> ac3b90613434a2c8c1ca84f8cd469a446eaa849e
