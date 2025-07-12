<?php
namespace App\Repositories;

use App\Models\PostCategory;
use App\Repositories\Interfaces\PostCategoryRepositoryInterface;

class PostCategoryRepository extends BaseRepository implements PostCategoryRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return PostCategory::class;
    }
}
