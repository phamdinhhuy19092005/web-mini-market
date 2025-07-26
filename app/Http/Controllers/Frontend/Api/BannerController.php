<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\BannerResource;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;

class BannerController extends BaseController
{
    public function index(): JsonResponse
    {
        $banners = Banner::all();
        return $this->jsonResponse(true, BannerResource::collection($banners));
    }

    public function show($id): JsonResponse
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return $this->jsonResponse(false, null, 'Banner không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new BannerResource($banner));
    }
}