<?php
namespace App\Repositories;

use App\Models\CategoryGroup;
use App\Repositories\Interfaces\CategoryGroupRepositoryInterface;

class CategoryGroupRepository extends BaseRepository implements CategoryGroupRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return CategoryGroup::class;
    }
}
