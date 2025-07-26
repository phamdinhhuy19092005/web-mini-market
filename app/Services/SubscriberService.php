<?php
namespace App\Services;

use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SubscriberService extends BaseService
{
    protected $subscriberRepository;

    public function __construct(SubscriberRepositoryInterface $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->subscriberRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function delete($id)
    {
        return $this->subscriberRepository->delete($id);
    }
}
