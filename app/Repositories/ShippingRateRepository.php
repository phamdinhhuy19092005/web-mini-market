<?php
namespace App\Repositories;

use App\Models\ShippingRate;
use App\Repositories\Interfaces\ShippingRateRepositoryInterface;

class ShippingRateRepository extends BaseRepository implements ShippingRateRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return ShippingRate::class;
    }
}
