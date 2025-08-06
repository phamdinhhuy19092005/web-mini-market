<?php
namespace App\Repositories;

use App\Models\ShippingOption;
use App\Repositories\Interfaces\ShippingOptionRepositoryInterface;

class ShippingOptionRepository extends BaseRepository implements ShippingOptionRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return ShippingOption::class;
    }
}
