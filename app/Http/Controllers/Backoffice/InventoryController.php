<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreInventoryResponseContract;
use App\Contracts\Responses\Backoffice\UpdateInventoryResponseContract;
use App\Enum\InventoryConditionEnum;
use App\Enum\ProductTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreInventoryRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateInventoryRequestInterface;
use App\Models\AttributeValue;
use App\Models\Inventory;
use App\Models\Product;
use App\Services\AttributeService;
use App\Services\InventoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class InventoryController extends BaseController
{
    protected $inventoryService;
    protected $attributeService;
    protected $productService;

    public function __construct(InventoryService $inventoryService, AttributeService $attributeService, ProductService $productService)
    {
        $this->inventoryService = $inventoryService;
        $this->attributeService = $attributeService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = Product::all();
        $attributes = $this->attributeService
            ->allAvailable(['with' => 'attributeValues', 'columns' => ['id', 'name', 'order']])
            ->sortBy('order')
            ->filter(fn($attribute) => !$attribute->attributeValues->isEmpty());
        return view('backoffice.pages.inventories.index', compact('products', 'attributes'));
    }

    public function create(Request $request)
    {
        $product = $this->productService->show($request->input('product_id'));
        $inventory = new Inventory();

        $selectedProduct = null;
        $productId = $request->query('product_id');
        $inventoryConditionEnumLabels = InventoryConditionEnum::labels();

        if ($productId) {
            $selectedProduct = Product::find($productId);
        }

        $hasVariant = $product->type == ProductTypeEnum::VARIABLE;

        // Load attributeValues và attribute nếu có từ request (biến thể)
        $attributeValueIds = collect($request->query())->filter(function ($value, $key) {
            return str_starts_with($key, 'attribute_values');
        })->flatten()->all();

        if (!empty($attributeValueIds)) {
            // Gắn tạm các attributeValues vào $inventory để hiển thị ra view
            $inventory->setRelation('attributeValues', AttributeValue::with('attribute')->whereIn('id', $attributeValueIds)->get());
        }

        return view('backoffice.pages.inventories.create', compact(
            'product',
            'selectedProduct',
            'inventory',
            'hasVariant',
            'inventoryConditionEnumLabels'
        ));
    }


    public function store(StoreInventoryRequestInterface $request)
    {
        $inventory = $this->inventoryService->create($request->validated());
        
        return $this->responses(StoreInventoryResponseContract::class, $inventory);
    }

    public function edit($id)
    {
        $inventory = $this->inventoryService->show($id);
        $product = $inventory->product;
        $selectedProduct = $product;
        $hasVariant = $product->type == ProductTypeEnum::VARIABLE;
        $inventoryConditionEnumLabels = InventoryConditionEnum::labels();

        $inventory->load('attributeValues.attribute');

        $inventory->key_features = is_string($inventory->key_features) ? json_decode($inventory->key_features ?? '[]', true) : $inventory->key_features;

        return view('backoffice.pages.inventories.create', compact(
            'inventory',
            'product',
            'selectedProduct',
            'hasVariant',
            'inventoryConditionEnumLabels'
        ));
    }

    public function update(UpdateInventoryRequestInterface $request, $id)
    {
        $inventory = $this->inventoryService->update($id, $request->validated());

        return $this->responses(UpdateInventoryResponseContract::class, $inventory);
    }

    public function destroy($id)
    {
        $this->inventoryService->delete($id);

        return redirect()->route('bo.web.inventories.index');
    }
}
