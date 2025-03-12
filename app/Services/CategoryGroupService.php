<?php
namespace App\Services;

use App\Classes\ImageHelper;
use App\Repositories\Interfaces\CategoryGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryGroupService extends BaseService
{
    protected $categoryGroupRepository;

    public function __construct(CategoryGroupRepositoryInterface $categoryGroupRepository)
    {
        $this->categoryGroupRepository = $categoryGroupRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->categoryGroupRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function() use ($attributes) {
            /**
             * cau hinh trong filesystems.php
             *
             */

            // users mua sap

            // transanction() A -> mo transanction
            // {
            //     -> lay san pham tu db
            //     -> tao 1 trog gio hang (A)
            //     -> tao dia chi giao hang

            //     -> lay ra xem san pham A

            //     -> dat hang: chuyen san pham trong gio sang orders
            //     -> delete sap pham trong gio []
            //     -> giao hang

            // }

            // transanction B () {
            //     -> lay ra xem san pham A tu gio hang
            // }
            $attributes['image'] = (new ImageHelper('category_group'))->upload($attributes['image']);

            return $this->categoryGroupRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->categoryGroupRepository->find($id);
    }

    public function show($id)
    {
        return $this->categoryGroupRepository->findOrFail($id);
    }

    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $category_group = $this->show($id);

            // Xử lý ảnh
            if ($image) {
                // Xóa ảnh cũ nếu tồn tại
                if ($category_group->image) {
                    (new ImageHelper('category'))->delete($category_group->image);
                }
                // Tải lên ảnh mới
                $attributes['image'] = (new ImageHelper('category'))->upload(['file' => $image]);
            // } elseif (isset($attributes['image']['path'])) {
            } elseif (! data_get($attributes, 'image.path')) {
                // Giữ đường dẫn hiện tại nếu không có ảnh mới
                // $attributes['image'] = $attributes['image']['path'];
                $attributes['image'] = data_get($attributes, 'image.path');
            } else {
                // Giữ ảnh cũ nếu không có dữ liệu mới
                $attributes['image'] = $category_group->image;
            }

            // Cập nhật trạng thái
            // $attributes['status'] = isset($attributes['status']) ? (bool) $attributes['status'] : 0;
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);


            // Cập nhật model
            $category_group->update($attributes);

            return $category_group;
        });
    }

    public function delete($id)
    {
        return $this->categoryGroupRepository->delete($id);
    }
}
