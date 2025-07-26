<?php

namespace App\Services;

use App\Classes\ImageHelper;
use App\Models\Admin;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->productRepository->model()::query()
            ->with(['brand', 'createdBy', 'updatedBy', 'inventories'])
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
                (new ImageHelper('product'))->delete($oldImagePath);
            }

            return (new ImageHelper('product'))->upload($newImage['file']);
        }

        if (isset($newImage['path'])) {
            return $newImage['path'];
        }

        return $oldImagePath;
    }

    protected function generateUniqueCode($length = 5)
    {
        do {
            $code = strtoupper(\Illuminate\Support\Str::random($length));
        } while ($this->productRepository->model()::where('code', $code)->exists());

        return $code;
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $imageHelper = new ImageHelper('product');

            $attributes['primary_image'] = $this->handleImageUpdate(null, $attributes['primary_image']);

            $mediaPaths = [];
            $mediaFiles = $attributes['media']['file'] ?? [];
            $mediaUrls = $attributes['media']['path'] ?? [];

            foreach ($mediaFiles as $index => $file) {
                $mediaPaths[] = $file instanceof \Illuminate\Http\UploadedFile
                    ? $imageHelper->upload($file)
                    : ($mediaUrls[$index] ?? null);
            }
            $attributes['media'] = json_encode(array_filter($mediaPaths));

            $adminClass = Admin::class;
            $adminId = auth('admin')->id();
            $attributes = array_merge($attributes, [
                'created_by_type' => $adminClass,
                'created_by_id' => $adminId,
                'updated_by_type' => $adminClass,
                'updated_by_id' => $adminId,
                'code' => $attributes['code'] ?? $this->generateUniqueCode(),
            ]);

            $categoryIds = $attributes['category_ids'] ?? [];
            $subcategoryIds = $attributes['subcategory_ids'] ?? [];
            unset($attributes['category_ids'], $attributes['subcategory_ids']);

            $product = $this->productRepository->create($attributes);
            $product->categories()->sync($categoryIds);
            $product->subcategories()->sync($subcategoryIds);

            return $product;
        });
    }


    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function show($id)
    {
        return $this->productRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return DB::transaction(function () use ($id, $attributes) {
            $product = $this->productRepository->findOrFail($id);
            $imageHelper = new ImageHelper('product');

            // Xử lý primary_image
            $attributes['primary_image'] = $this->handleImageUpdate($product->primary_image, $attributes['primary_image'] ?? null);

            // Xử lý media
            $mediaPaths = [];
            $oldMedia = is_string($product->media) ? json_decode($product->media, true) : ($product->media ?? []);
            $oldMedia = is_array($oldMedia) ? $oldMedia : [];
            $mediaFiles = $attributes['media']['file'] ?? [];
            $mediaUrls = $attributes['media']['path'] ?? [];

            // Duy trì các ảnh cũ và thêm ảnh mới
            foreach ($mediaUrls as $index => $url) {
                if (!empty($url)) {
                    $mediaPaths[] = $url; // Giữ URL nếu hợp lệ
                }
            }

            foreach ($mediaFiles as $index => $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $mediaPaths[] = $imageHelper->upload($file); // Upload ảnh mới
                }
            }

            // Xóa các ảnh cũ không còn trong danh sách mới
            foreach ($oldMedia as $oldPath) {
                if (!in_array($oldPath, $mediaPaths)) {
                    $imageHelper->delete($oldPath);
                }
            }

            $attributes['media'] = json_encode($mediaPaths);

            // Xử lý status
            $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : $product->status;

            // Xử lý admin
            $adminId = optional(auth('admin')->user())->id;
            $attributes['updated_by_type'] = \App\Models\Admin::class;
            $attributes['updated_by_id'] = $adminId;

            // Xử lý category_ids và subcategory_ids
            $categoryIds = $attributes['category_ids'] ?? [];
            unset($attributes['category_ids']);

            $subcategoryIds = $attributes['subcategory_ids'] ?? [];
            unset($attributes['subcategory_ids']);

            // Cập nhật sản phẩm
            $this->productRepository->update($id, $attributes, $adminId);

            // Cập nhật danh mục và danh mục con
            $product->categories()->sync($categoryIds);
            $product->subcategories()->sync($subcategoryIds);

            return $product->fresh();
        });
    }


    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}
