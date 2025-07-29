<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\AutoDiscountResource;
use App\Models\AutoDiscount;
use Illuminate\Http\JsonResponse;

class AutoDiscountController extends BaseController
{
    public function index(): JsonResponse
    {
        $auto_discounts = AutoDiscount::all();
        return $this->jsonResponse(true, AutoDiscountResource::collection($auto_discounts));
    }

    public function show($id): JsonResponse
    {
        $auto_discount = AutoDiscount::find($id);
        if (!$auto_discount) {
            return $this->jsonResponse(false, null, 'Mã giảm giá không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new AutoDiscountResource($auto_discount));
    }
}