<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\BrandResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Frontend\ProductResource;
use App\Models\Brand;

class ProductController extends BaseController
{
    public function index(): JsonResponse
    {
        $query = Product::with(['brand', 'inventories', 'subcategories.category.categoryGroup']);

        if (request()->has('brand_slug') && request()->brand_slug) {
            $query->whereHas('brand', function ($q) {
                $q->where('slug', request()->brand_slug);
            });
        }

        if (request()->has('category_id') && request()->category_id) {
            $query->whereHas('subcategories.category', function ($q) {
                $q->where('id', request()->category_id);
            });
        }

        $products = $query->get();

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products)
        ]);
    }

    public function show($slug): JsonResponse
    {
        $brand = Brand::where('slug', $slug)
            ->with(['products' => function($q) {
                $q->with(['inventories', 'subcategories.category.categoryGroup']);
            }])
            ->first();

        if (!$brand) {
            return $this->jsonResponse(false, null, 'Thương hiệu không tìm thấy', 404);
        }

        return $this->jsonResponse(true, [
            'brand' => new BrandResource($brand),
            'products' => ProductResource::collection($brand->products)
        ]);
    }

}