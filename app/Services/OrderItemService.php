<?php
namespace App\Services;

use App\Enum\PageDisplayInEnum;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderItemService extends BaseService
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepositoryInterface $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query    = data_get($data, 'query');
        $perPage  = data_get($data, 'per_page', 10);
        $orderId  = data_get($data, 'order_id');

        return $this->orderItemRepository->model()::query()
            ->with('inventory')
            ->when($orderId, fn($q) => $q->where('order_id', $orderId))
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('id', $query)
                    ->orWhereHas('inventory', fn($q3) => $q3->where('title', 'like', "%$query%"));
                });
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

            return $this->orderItemRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->orderItemRepository->find($id);
    }

    public function show($id)
    {
        return $this->orderItemRepository->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return DB::transaction(function () use ($id, $attributes) {
            $item = $this->show($id);

            $user = auth('admin')->user();
            $attributes['updated_by_type'] = get_class($user);
            $attributes['updated_by_id'] = $user->id;

            $item->update($attributes);

            return $item;
        });
    }


    public function delete($id)
    {
        return $this->orderItemRepository->delete($id);
    }
}
