<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\FaqTopicResource;
use App\Models\FaqTopic;
use Illuminate\Http\JsonResponse;

class FaqTopicController extends BaseController
{
    public function index(): JsonResponse
    {
        $faqTopics = FaqTopic::all();
        return $this->jsonResponse(true, FaqTopicResource::collection($faqTopics));
    }

    public function show($id): JsonResponse
    {
        $faqTopic = FaqTopic::find($id);
        if (!$faqTopic) {
            return $this->jsonResponse(false, null, 'Chủ đề FAQ không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new FaqTopicResource($faqTopic));
    }
}