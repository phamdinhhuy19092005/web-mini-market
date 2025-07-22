<?php
namespace App\Repositories;

use App\Models\AutoDiscount;
use App\Repositories\Interfaces\AutoDiscountRepositoryInterface;

class AutoDiscountRepository extends BaseRepository implements AutoDiscountRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return AutoDiscount::class;
    }
}
