<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListInventoryResponseContract;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends BaseApiController
{
    public function __construct(protected InventoryService $inventoryService)
    {
    }

    public function index(Request $request)
    {
        $inventories = $this->inventoryService->searchByAdmin($request->all());
        
        return $this->responses(ListInventoryResponseContract::class, $inventories);
    }
}
