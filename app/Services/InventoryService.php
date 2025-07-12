<?php
namespace App\Services;

use App\Repositories\Interfaces\InventoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use (&$attributes) {
            $admin = auth('admin')->user();

            $imagePath = data_get($attributes, 'image.path');
            
            if ($imagePath) {
                $attributes['image'] = $imagePath;
            }

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

            $attributes['key_features'] = is_array($attributes['key_features'] ?? null)
                ? json_encode($attributes['key_features'])
                : json_encode([]);

            return $this->inventoryRepository->create($attributes);
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
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->inventoryRepository->findOrFail($id);

            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;
            $attributes['display_on_frontend'] = isset($attributes['display_on_frontend']);
            $attributes['allow_frontend_search'] = isset($attributes['allow_frontend_search']);
            $attributes['meta_keywords'] = $attributes['meta_keywords'] ?? null;

            $imagePath = data_get($attributes, 'image.path');
            
            if ($imagePath) {
                $attributes['image'] = $imagePath;
            }

            return $this->inventoryRepository->update($id, $attributes);
        });
    }


    public function delete($id)
    {
        return $this->inventoryRepository->delete($id);
    }
}
