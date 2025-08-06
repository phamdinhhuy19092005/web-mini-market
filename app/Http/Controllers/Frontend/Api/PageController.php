<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\PageResource;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends BaseController
{
    public function index(): JsonResponse
    {
        $pages = Page::all();
        return $this->jsonResponse(true, PageResource::collection($pages));
    }

    public function show($id): JsonResponse
    {
        $page = Page::find($id);
        if (!$page) {
            return $this->jsonResponse(false, null, 'Trang không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new PageResource($page));
    }
}
