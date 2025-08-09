<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Frontend\ProductResource; 

class ProductController extends BaseController
{
    public function index(): JsonResponse
    {
        $query = Product::with(['brand', 'inventories', 'subcategories.category.categoryGroup']);

        if (request()->has('brand_id') && request()->brand_id) {
            $query->where('brand_id', request()->brand_id);
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

    public function show($id): JsonResponse
    {   
        $product = Product::with([
            'brand',
            'inventories',
            'subcategories.category.categoryGroup' 
        ])->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ProductResource($product)
        ]);
    }
}