<?php

namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\BannerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BannerService extends BaseService
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Search banners by ID or name for admin panel.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchByAdmin(array $data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->bannerRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    /**
     * Create a new banner.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $imageHelper = new ImageHelper('banner');

            if (isset($attributes['desktop_image'])) {
                $attributes['desktop_image'] = $imageHelper->upload($attributes['desktop_image']);
            }

            if (isset($attributes['mobile_image'])) {
                $attributes['mobile_image'] = $imageHelper->upload($attributes['mobile_image']);
            }

            return $this->bannerRepository->create($attributes);
        });
    }

    /**
     * Find banner by ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->bannerRepository->findOrFail($id);
    }

    /**
     * Show banner details (alias of find).
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * Update an existing banner.
     *
     * @param int $id
     * @param array $attributes
     * @param \Illuminate\Http\UploadedFile|null $image
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $attributes = [])
    {
        return DB::transaction(function () use ($id, $attributes) {
            $model = $this->bannerRepository->findOrFail($id);

            $attributes['desktop_image'] = $this->handleImageUpdate($model->desktop_image, $attributes['desktop_image'] ?? null);
            $attributes['mobile_image'] = $this->handleImageUpdate($model->mobile_image, $attributes['mobile_image'] ?? null);

            // Update status if provided
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $model->status;

            return $this->bannerRepository->update($id, $attributes);
        });
    }

    /**
     * Handle banner image updates (desktop/mobile).
     *
     * @param string|null $oldImagePath
     * @param array|null $newImage
     * @return string|null
     */
    protected function handleImageUpdate($oldImagePath, $newImage = null)
    {
        if (isset($newImage['file']) && $newImage['file'] instanceof \Illuminate\Http\UploadedFile) {
            if ($oldImagePath) {
                (new ImageHelper('banner'))->delete($oldImagePath);
            }

            return (new ImageHelper('banner'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    /**
     * Delete a banner and its associated images.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $model = $this->bannerRepository->findOrFail($id);

            if ($model->desktop_image) {
                (new ImageHelper('banner'))->delete($model->desktop_image);
            }

            if ($model->mobile_image) {
                (new ImageHelper('banner'))->delete($model->mobile_image);
            }

            return $this->bannerRepository->delete($id);
        });
    }
}
