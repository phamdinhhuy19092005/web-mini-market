<?php
namespace App\Services;

use App\Enum\PageDisplayInEnum;
use App\Repositories\Interfaces\PageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PageService extends BaseService
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->pageRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            $user = auth('admin')->user();

            $attributes += [
                'created_by_type' => get_class($user),
                'created_by_id'   => $user->id,
                'updated_by_type' => get_class($user),
                'updated_by_id'   => $user->id,
            ];

            return $this->pageRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->pageRepository->find($id);
    }

    public function show($id)
    {
        return $this->pageRepository->findOrFail($id);
    }

   public function update($id, array $attributes)
    {
        return DB::transaction(function () use ($id, $attributes) {
                $page = $this->show($id);

                // Xử lý display_in
                if (isset($attributes['display_in']) && is_array($attributes['display_in'])) {
                    $validDisplays = array_keys(PageDisplayInEnum::labels());
                    $attributes['display_in'] = array_filter($attributes['display_in'], function ($value) use ($validDisplays) {
                        return in_array($value, $validDisplays);
                    });
                    $encoded = json_encode($attributes['display_in']);
                    if ($encoded === false) {
                        throw new \Exception('Failed to encode display_in to JSON');
                    }
                    $attributes['display_in'] = $encoded;
                } else {
                    $attributes['display_in'] = json_encode([]);
                }

                // Chuyển đổi boolean
                $attributes['status'] = (bool) data_get($attributes, 'status', 0);
                $attributes['display_on_frontend'] = (bool) data_get($attributes, 'display_on_frontend', 0);

                // Cập nhật thông tin người chỉnh sửa
                $user = auth('admin')->user();
                $attributes['updated_by_type'] = get_class($user);
                $attributes['updated_by_id'] = $user->id;

                $page->update($attributes);

                return $page;
 
        });
    }

    public function delete($id)
    {
        return $this->pageRepository->delete($id);
    }
}
