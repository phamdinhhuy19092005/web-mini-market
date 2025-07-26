<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;

class FaqController extends BaseController
{
    public function index(): JsonResponse
    {
        $faqs = Faq::all();
        return $this->jsonResponse(true, FaqResource::collection($faqs));
    }

    public function show($id): JsonResponse
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return $this->jsonResponse(false, null, 'FAQ không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new FaqResource($faq));
    }
}