<?php
namespace App\Services;

use App\Repositories\Interfaces\AttributeValueRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AttributeValueService extends BaseService
{
    protected $attributeValueRepository;

    public function __construct(AttributeValueRepositoryInterface $attributeValueRepository)
    {
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->attributeValueRepository->model()::query()
            ->with('attribute') 
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('value', 'like', "%$query%")
                ->orWhereHas('attribute', function ($sub) use ($query) {
                    $sub->where('name', 'like', "%$query%");
                });
            })
            ->paginate($perPage);
    }


    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->attributeValueRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->attributeValueRepository->find($id);
    }

    public function show($id)
    {
        return $this->attributeValueRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->attributeValueRepository->findOrFail($id);

            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->attributeValueRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->attributeValueRepository->delete($id);
    }
}
