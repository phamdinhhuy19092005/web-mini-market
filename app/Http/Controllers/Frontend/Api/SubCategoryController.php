<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;

class SubCategoryController extends BaseController
{
    public function index(): JsonResponse
    {
        $subCategories = SubCategory::all();
        return $this->jsonResponse(true, SubCategoryResource::collection($subCategories));
    }

    public function show($slug): JsonResponse
    {
        $subCategory = SubCategory::where('slug', $slug)->first();
        if (!$subCategory) {
            return $this->jsonResponse(false, null, 'Danh mục con không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new SubCategoryResource($subCategory));
    }
}