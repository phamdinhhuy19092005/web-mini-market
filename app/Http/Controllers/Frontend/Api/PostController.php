<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends BaseController
{
    public function index(): JsonResponse
    {
        $posts = Post::all();
        return $this->jsonResponse(true, PostResource::collection($posts));
    }

    public function showBySlug($slug): JsonResponse
    {
        $post = Post::where('slug', $slug)->first();
        if (!$post) {
            return $this->jsonResponse(false, null, 'Bài viết không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new PostResource($post));
    }

}
