<?php
namespace App\Repositories;

use App\Models\AttributeValue;
use App\Repositories\Interfaces\AttributeValueRepositoryInterface;

class AttributeValueRepository extends BaseRepository implements AttributeValueRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return AttributeValue::class;
    }
}
