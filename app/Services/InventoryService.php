<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Models\Inventory;
use App\Repositories\Interfaces\InventoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryService extends BaseService
{
    protected $inventoryRepository;

    public function __construct(InventoryRepositoryInterface $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

   public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->inventoryRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('title', 'like', "%{$query}%")
                ->orWhere('sku', 'like', "%{$query}%");
            })
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function getActiveInventoriesWithFinalPrice()
    {
        $now = Carbon::now();

        return Inventory::select(
            'id', 'title', 'sku', 'sale_price', 'offer_price',
            'offer_start', 'offer_end', 'image', 'slug', 'stock_quantity'
        )
        ->where('status', 1)
        ->get()
        ->map(function ($inventory) use ($now) {
            $inventory->final_price =
                $inventory->offer_price &&
                $inventory->offer_start &&
                $inventory->offer_end &&
                $now->between($inventory->offer_start, $inventory->offer_end)
                    ? $inventory->offer_price
                    : $inventory->sale_price;

            return $inventory;
        });
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use (&$attributes) {
            $imageResult = (new ImageHelper('inventory'))->upload($attributes['image']);
            $admin = auth('admin')->user();

            $attributes['image'] = is_array($imageResult) ? $imageResult['path'] : $imageResult;

            $attributes['created_by_type'] = (string) get_class($admin);
            $attributes['created_by_id'] = (int) $admin->id;
            $attributes['updated_by_type'] = (string) get_class($admin);
            $attributes['updated_by_id'] = (int) $admin->id;

            $attributes['display_on_frontend'] = isset($attributes['display_on_frontend']);
            $attributes['allow_frontend_search'] = isset($attributes['allow_frontend_search']);
            $attributes['meta_keywords'] = $attributes['meta_keywords'] ?? null;
            $attributes['meta_title'] = is_string($attributes['meta_title'] ?? '') ? $attributes['meta_title'] : '';
            $attributes['meta_description'] = is_string($attributes['meta_description'] ?? '') ? $attributes['meta_description'] : '';
            $attributes['condition_note'] = is_string($attributes['condition_note'] ?? '') ? $attributes['condition_note'] : '';
            $attributes['image'] = is_string($attributes['image'] ?? '') ? $attributes['image'] : null;

            $attributes['key_features'] = is_array($attributes['key_features'] ?? null) ? json_encode($attributes['key_features']) : json_encode([]);

            $inventory = $this->inventoryRepository->create($attributes);

            if (isset($attributes['attribute_values']) && is_array($attributes['attribute_values'])) {
                foreach ($attributes['attribute_values'] as $attributeId => $attributeValueIds) {
                    foreach ((array) $attributeValueIds as $attributeValueId) {
                        if ($attributeValueId) {
                            $inventory->attributes()->attach($attributeId, [
                                'attribute_value_id' => $attributeValueId,
                            ]);
                        }
                    }
                }
            }
            $inventory->load('attributeValues.attribute');

            return $inventory;
        });
    }
    

    public function find($id)
    {
        return $this->inventoryRepository->find($id);
    }

    public function show($id)
    {
        return $this->inventoryRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, &$attributes) {
            $model = $this->inventoryRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;
            $attributes['display_on_frontend'] = isset($attributes['display_on_frontend']);
            $attributes['allow_frontend_search'] = isset($attributes['allow_frontend_search']);
            $attributes['meta_keywords'] = $attributes['meta_keywords'] ?? null;
            $attributes['meta_title'] = is_string($attributes['meta_title'] ?? '') ? $attributes['meta_title'] : '';
            $attributes['meta_description'] = is_string($attributes['meta_description'] ?? '') ? $attributes['meta_description'] : '';
            $attributes['condition_note'] = is_string($attributes['condition_note'] ?? '') ? $attributes['condition_note'] : '';
            $attributes['image'] = is_string($attributes['image'] ?? '') ? $attributes['image'] : $model->image;
            $attributes['key_features'] = is_array($attributes['key_features'] ?? null) ? json_encode($attributes['key_features']) : json_encode($model->key_features ?? []);
            $inventory = $this->inventoryRepository->update($id, $attributes);

            if (isset($attributes['attribute_values']) && is_array($attributes['attribute_values'])) {
                $model->attributes()->detach();
                foreach ($attributes['attribute_values'] as $attributeId => $attributeValueIds) {
                    foreach ((array) $attributeValueIds as $attributeValueId) {
                        if ($attributeValueId) {
                            $model->attributes()->attach($attributeId, [
                                'attribute_value_id' => $attributeValueId,
                            ]);
                        }
                    }
                }
            }
            $inventory->load('attributeValues.attribute');

            return $inventory;
        });
    }

    public function delete($id)
    {
        return $this->inventoryRepository->delete($id);
    }

    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('inventory'))->delete($oldImagePath);
            }

            return (new ImageHelper('inventory'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }
}
