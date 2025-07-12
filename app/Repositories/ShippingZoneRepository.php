<?php
namespace App\Repositories;

use App\Models\ShippingZone;
use App\Repositories\Interfaces\ShippingZoneRepositoryInterface;

class ShippingZoneRepository extends BaseRepository implements ShippingZoneRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return ShippingZone::class;
    }
}
