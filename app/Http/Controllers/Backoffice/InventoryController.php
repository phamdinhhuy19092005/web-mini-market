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
use Illuminate\Support\Facades\Log;

class InventoryController extends BaseController
{
    protected $inventoryService;
    protected $attributeService;
    protected $productService;

    public function __construct(
        InventoryService $inventoryService,
        AttributeService $attributeService,
        ProductService $productService
    ) {
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
            ->filter(fn($attr) => $attr->attributeValues->isNotEmpty());

        return view('backoffice.pages.inventories.index', compact('products', 'attributes'));
    }

    public function create(Request $request)
    {
        $productId = $request->query('product_id');
        $product = $productId ? $this->productService->show($productId) : null;
        $inventory = new Inventory();

        if ($productId) {
            $selectedProduct = Product::find($productId);
            $hasVariant = $selectedProduct?->type === ProductTypeEnum::VARIABLE;
        } else {
            $selectedProduct = null;
            $hasVariant = false;
        }

        $attributes = $this->attributeService->allAvailable(['with' => 'attributeValues', 'columns' => ['id', 'name', 'order']])->sortBy('order')->filter(fn($attr) => $attr->attributeValues->isNotEmpty());

        $attributeValueIds = collect($request->query())->filter(fn($v, $k) => str_starts_with($k, 'attribute_values'))->flatten()->all();
        if (!empty($attributeValueIds)) {
            $inventory->setRelation('attributeValues', AttributeValue::with('attribute')->whereIn('id', $attributeValueIds)->get());
        }

        return view('backoffice.pages.inventories.create', [
            'product' => $product,
            'selectedProduct' => $selectedProduct,
            'inventory' => $inventory,
            'hasVariant' => $hasVariant,
            'inventoryConditionEnumLabels' => InventoryConditionEnum::labels(),
            'attributes' => $attributes, // Truyền attributes vào view
        ]);
    }

    public function store(StoreInventoryRequestInterface $request)
    {
        Log::info('Store inventory request:', $request->validated());
        $inventory = $this->inventoryService->create($request->validated());
        Log::info('Created inventory:', $inventory->toArray());

        return $this->responses(StoreInventoryResponseContract::class, $inventory);
    }

    public function edit($id)
    {
        $inventory = $this->inventoryService->show($id);
        $inventory->load('attributeValues.attribute');

        $inventory->key_features = is_string($inventory->key_features) ? json_decode($inventory->key_features ?? '[]', true) : $inventory->key_features;

        $attributes = $this->attributeService->allAvailable(['with' => 'attributeValues', 'columns' => ['id', 'name', 'order']])->sortBy('order')->filter(fn($attr) => $attr->attributeValues->isNotEmpty());

        return view('backoffice.pages.inventories.create', [
            'inventory' => $inventory,
            'product' => $inventory->product,
            'selectedProduct' => $inventory->product,
            'hasVariant' => $inventory->product->type === ProductTypeEnum::VARIABLE,
            'inventoryConditionEnumLabels' => InventoryConditionEnum::labels(),
            'attributes' => $attributes, 
        ]);
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