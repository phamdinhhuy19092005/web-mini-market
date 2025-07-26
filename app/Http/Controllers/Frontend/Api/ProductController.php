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
        $products = Product::with(['brand', 'inventories'])->get();

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products)
        ]);
    }

    public function show($id): JsonResponse
    {   
        $product = Product::with(['brand', 'inventories'])->find($id);

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