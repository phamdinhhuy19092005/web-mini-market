<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\InventoryResource;
use Illuminate\Http\JsonResponse;
use App\Models\Inventory;


class ProductController extends BaseController
{
    public function showByInventorySlug($subcategory_slug, $inventory_slug): JsonResponse
    {
        $inventory = Inventory::with(['product.subcategories.category.categoryGroup', 'product.brand'])
            ->where('slug', $inventory_slug)
            ->whereHas('product.subcategories', function ($q) use ($subcategory_slug) {
                $q->where('slug', $subcategory_slug);
            })
            ->first();

        if (!$inventory) {
            return response()->json([
                'success' => false,
                'message' => 'Inventory not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new InventoryResource($inventory)
        ]);
    }

}

