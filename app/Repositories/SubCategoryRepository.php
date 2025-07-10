<?php
namespace App\Repositories;

use App\Models\SubCategory;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return SubCategory::class;
    }
}
