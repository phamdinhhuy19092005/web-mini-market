<?php
namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return Post::class;
    }
}
