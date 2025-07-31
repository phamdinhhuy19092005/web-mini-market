<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\WardResource;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;

class WardController extends BaseController
{
    public function index(): JsonResponse
    {
        $wards = Ward::all();
        return $this->jsonResponse(true, WardResource::collection($wards));
    }

    public function show($id): JsonResponse
    {
        $wards = Ward::find($id);
        if (!$wards) {
            return $this->jsonResponse(false, null, 'Thuộc tính không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new WardResource($wards));
    }
}