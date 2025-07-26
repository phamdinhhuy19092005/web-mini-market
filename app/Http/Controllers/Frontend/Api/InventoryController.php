<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;

class InventoryController extends BaseController
{
    public function index(): JsonResponse
    {
        $inventories = Inventory::all();
        return $this->jsonResponse(true, InventoryResource::collection($inventories));
    }

    public function show($id): JsonResponse
    {
        $inventory = Inventory::find($id);
        if (!$inventory) {
            return $this->jsonResponse(false, null, 'Kho hàng không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new InventoryResource($inventory));
    }
}