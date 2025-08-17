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
        $reviews = WebsiteReview::with('user')->get();
        return $this->jsonResponse(true, WebsiteReviewResource::collection($reviews));
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'rating'  => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
                'status'  => 'nullable|boolean'
            ]);

            $review = WebsiteReview::create([
                'user_id' => $request->user()->id,
                'name'    => $request->user()->name,
                'avatar'  => $request->user()->avatar,
                'rating'  => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
                'status'  => $validated['status'] ?? 1,
            ]);

            return $this->jsonResponse(true, new WebsiteReviewResource($review), 'Tạo đánh giá thành công');
        } catch (\Exception $e) {
            return $this->jsonResponse(false, null, 'Lỗi khi tạo đánh giá: ' . $e->getMessage(), 500);
        }
    }

}
