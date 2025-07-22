<?php
namespace App\Services;

use App\Repositories\Interfaces\AutoDiscountRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AutoDiscountService extends BaseService
{
    protected $autoDiscountRepository;

    public function __construct(AutoDiscountRepositoryInterface $autoDiscountRepository)
    {
        $this->autoDiscountRepository = $autoDiscountRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->autoDiscountRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->autoDiscountRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->autoDiscountRepository->find($id);
    }

    public function show($id)
    {
        return $this->autoDiscountRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
            return $this->autoDiscountRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->autoDiscountRepository->delete($id);
    }
}
