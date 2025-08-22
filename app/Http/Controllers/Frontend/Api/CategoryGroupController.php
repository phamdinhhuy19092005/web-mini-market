<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Backoffice\CategoryGroupResource as BackofficeCategoryGroupResource;
use App\Http\Resources\Frontend\CategoryGroupResource;
use App\Models\CategoryGroup;
use Illuminate\Http\JsonResponse;

class CategoryGroupController extends BaseController
{
    public function index(): JsonResponse
    {
        $categoryGroups = CategoryGroup::all();
        return $this->jsonResponse(true, BackofficeCategoryGroupResource::collection($categoryGroups));
    }

    public function showBySlug($slug): JsonResponse
    {
        $categoryGroup = CategoryGroup::where('slug', $slug)->first();
        if (!$categoryGroup) {
            return $this->jsonResponse(false, null, 'Nhóm danh mục không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new CategoryGroupResource($categoryGroup));
    }

}