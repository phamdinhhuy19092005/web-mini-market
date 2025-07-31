<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\WardResource;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WardController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $query = Ward::query();

        // Nếu có truyền district_code thì lọc theo nó
        if ($request->has('district_code')) {
            $query->where('district_code', $request->district_code);
        }

        $wards = $query->get();

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