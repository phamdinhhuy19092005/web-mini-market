<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;

class AttributeController extends BaseController
{
    public function index(): JsonResponse
    {
        $attributes = Attribute::all();
        return $this->jsonResponse(true, AttributeResource::collection($attributes));
    }

    public function show($id): JsonResponse
    {
        $attribute = Attribute::find($id);
        if (!$attribute) {
            return $this->jsonResponse(false, null, 'Thuộc tính không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new AttributeResource($attribute));
    }
}