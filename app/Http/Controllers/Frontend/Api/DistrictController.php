<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\DistrictResource;
use App\Models\District;
use Illuminate\Http\JsonResponse;

class DistrictController extends BaseController
{
    public function index(): JsonResponse
    {
        $districts = District::all();
        return $this->jsonResponse(true, DistrictResource::collection($districts));
    }

    public function show($id): JsonResponse
    {
        $district = District::find($id);
        if (!$district) {
            return $this->jsonResponse(false, null, 'Không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new DistrictResource($district));
    }
}