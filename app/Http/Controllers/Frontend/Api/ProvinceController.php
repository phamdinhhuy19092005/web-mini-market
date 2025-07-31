<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\ProvinceResource;
use App\Models\Province;
use Illuminate\Http\JsonResponse;

class ProvinceController extends BaseController
{
    public function index(): JsonResponse
    {
        $provinces = Province::all();
        return $this->jsonResponse(true, ProvinceResource::collection($provinces));
    }

    public function show($id): JsonResponse
    {
        $provinces = Province::find($id);
        if (!$provinces) {
            return $this->jsonResponse(false, null, 'Không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new ProvinceResource($provinces));
    }
}