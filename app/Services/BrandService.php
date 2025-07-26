<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BrandService extends BaseService
{
    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->brandRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('brand'))->delete($oldImagePath);
            }

            return (new ImageHelper('brand'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            // Configuration is set in filesystems.php
            $attributes['image'] = (new ImageHelper('brand'))->upload($attributes['image']);
            return $this->brandRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->brandRepository->find($id);
    }

    public function show($id)
    {
        return $this->brandRepository->findOrFail($id);
    }

    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->brandRepository->findOrFail($id);

            $attributes['image'] = $this->handleImageUpdate($model->image, $attributes['image'] ?? null);

            // Update status if provided
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->brandRepository->update($id, $attributes);
        });
    }

    public function delete($id)
    {
        return $this->brandRepository->delete($id);
    }
}