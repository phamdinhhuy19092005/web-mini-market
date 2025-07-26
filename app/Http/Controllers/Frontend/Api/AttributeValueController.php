<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\AttributeValueResource;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;

class AttributeValueController extends BaseController
{
    public function index(): JsonResponse
    {
        $attributeValues = AttributeValue::all();
        return $this->jsonResponse(true, AttributeValueResource::collection($attributeValues));
    }

    public function show($id): JsonResponse
    {
        $attributeValue = AttributeValue::find($id);
        if (!$attributeValue) {
            return $this->jsonResponse(false, null, 'Giá trị thuộc tính không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new AttributeValueResource($attributeValue));
    }
}