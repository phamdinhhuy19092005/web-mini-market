<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AttributeService extends BaseService
{
    protected $attributeRepository;

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->attributeRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function allAvailable(array $options = [])
    {
        $query = Attribute::query();
        
        if (isset($options['with'])) {
            $query->with($options['with']);
        }
        
        if (isset($options['columns'])) {
            $query->select($options['columns']);
        }
        
        return $query->get();
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
           $categoryIds = $attributes['category_ids'] ?? [];
            unset($attributes['category_ids']);

            $attribute = $this->attributeRepository->create($attributes);

            $attribute->categories()->sync($categoryIds);

            return $attribute;
        });
    }

    public function find($id)
    {
        return $this->attributeRepository->find($id);
    }

    public function show($id)
    {
        return $this->attributeRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $attribute = $this->attributeRepository->findOrFail($id);

            // Tách category_ids ra khỏi attributes
            $categoryIds = $attributes['category_ids'] ?? [];
            unset($attributes['category_ids']);

            $attributes['status'] = (bool) data_get($attributes, 'status', 0);

            $this->attributeRepository->update($id, $attributes);

            $attribute->categories()->sync($categoryIds);

            return $attribute->fresh(); 
        });
    }

    public function delete($id)
    {
        return $this->attributeRepository->delete($id);
    }
}
