<?php
namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\Interfaces\FaqRepositoryInterface;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return Faq::class;
    }
}
