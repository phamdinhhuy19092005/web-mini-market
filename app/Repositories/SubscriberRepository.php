<?php
namespace App\Repositories;

use App\Models\Subscriber;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;

class SubscriberRepository extends BaseRepository implements SubscriberRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return Subscriber::class;
    }
}
