<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\PostCategoryResource;
use App\Models\PostCategory;
use Illuminate\Http\JsonResponse;

class PostCategoryController extends BaseController
{
    public function index(): JsonResponse
    {
        $postCategories = PostCategory::with('posts')->get();
        return $this->jsonResponse(true, PostCategoryResource::collection($postCategories));
    }

    public function show($id): JsonResponse
    {
        $postCategory = PostCategory::with('posts')->find($id); 
        if (!$postCategory) {
            return $this->jsonResponse(false, null, 'Danh mục bài viết không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new PostCategoryResource($postCategory));
    }
}
