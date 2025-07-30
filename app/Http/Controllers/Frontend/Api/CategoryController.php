<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    public function index(): JsonResponse
    {
        $categories = Category::with('subcategoriesWithProducts')->get();
        return $this->jsonResponse(true, CategoryResource::collection($categories));
    }

    public function show($id): JsonResponse
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->jsonResponse(false, null, 'Danh mục không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new CategoryResource($category));
    }
}