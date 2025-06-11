<?php
namespace App\Repositories;

use App\Models\FaqTopic;
use App\Repositories\Interfaces\FaqTopicRepositoryInterface;

class FaqTopicRepository extends BaseRepository implements FaqTopicRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return FaqTopic::class;
    }
}
