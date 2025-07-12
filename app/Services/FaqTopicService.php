<?php
namespace App\Services;

use App\Repositories\Interfaces\FaqTopicRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FaqTopicService extends BaseService
{
    protected $faqTopicRepository;

    public function __construct(FaqTopicRepositoryInterface $faqTopicRepository)
    {
        $this->faqTopicRepository = $faqTopicRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->faqTopicRepository->model()::query()
            ->when($query, function ($q) use ($query) {
                $q->where('id', $query)
                    ->orWhere('name', 'like', "%$query%");
            })
            ->paginate($perPage);
    }

    public function create(array $attributes = [])
    {
        return DB::transaction(function () use ($attributes) {
            return $this->faqTopicRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->faqTopicRepository->find($id);
    }

    public function show($id)
    {
        return $this->faqTopicRepository->findOrFail($id);
    }

    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $faqTopic = $this->show($id);

            // Update status settings, default to 0 if not provided
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
        
            // Update model
            $faqTopic->update($attributes);
            return $faqTopic;
        });
    }

    public function delete($id)
    {
        return $this->faqTopicRepository->delete($id);
    }
}