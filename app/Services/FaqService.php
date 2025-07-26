<?php
namespace App\Services;

use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FaqService extends BaseService
{
    protected $faqRepository;

    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function searchByAdmin($data = [])
    {
        $query = data_get($data, 'query');
        $perPage = data_get($data, 'per_page', 10);

        return $this->faqRepository->model()::query()
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
            return $this->faqRepository->create($attributes);
        });
    }

    public function find($id)
    {
        return $this->faqRepository->find($id);
    }

    public function show($id)
    {
        return $this->faqRepository->findOrFail($id);
    }

    public function update($id, array $attributes, $image = null)
    {
        return DB::transaction(function () use ($id, $attributes, $image) {
            $faq = $this->show($id);

            // Update status settings, default to 0 if not provided
            $attributes['status'] = (bool) data_get($attributes, 'status', 0);
        
            // Update model
            $faq->update($attributes);
            return $faq;
        });
    }

    public function delete($id)
    {
        return $this->faqRepository->delete($id);
    }
}