<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\WebsiteReviewResource;
use App\Models\WebsiteReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebsiteReviewController extends BaseController
{
    public function index(): JsonResponse
    {
        $reviews = WebsiteReview::all();
        return $this->jsonResponse(true, WebsiteReviewResource::collection($reviews));
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $review = WebsiteReview::create($request->all());
            return $this->jsonResponse(true, new WebsiteReviewResource($review), 'Tạo đánh giá thành công');
        } catch (\Exception $e) {
            return $this->jsonResponse(false, null, 'Lỗi khi tạo đánh giá: ' . $e->getMessage(), 500);
        }
    }
}