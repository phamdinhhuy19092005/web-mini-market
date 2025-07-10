<?php
namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\Interfaces\AttributeRepositoryInterface;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return Attribute::class;
    }
}
