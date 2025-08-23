<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class BrandController extends BaseController
{
    public function index(): JsonResponse
    {
        $brands = Brand::all();
        return $this->jsonResponse(true, BrandResource::collection($brands));
    }

    public function show($slug): JsonResponse
    {
        $brand = Brand::where('slug', $slug)->first();

        if (!$brand) {
            return $this->jsonResponse(false, null, 'Thương hiệu không tìm thấy', 404);
        }

        return $this->jsonResponse(true, new BrandResource($brand));
    }
}
