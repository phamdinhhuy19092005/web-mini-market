<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\DistrictResource;
use App\Models\District;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistrictController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        $query = District::query();

        // Nếu có truyền province_code thì lọc theo nó
        if ($request->has('province_code')) {
            $query->where('province_code', $request->province_code);
        }

        $districts = $query->get();

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