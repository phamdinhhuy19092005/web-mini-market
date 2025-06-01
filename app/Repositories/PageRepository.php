<?php
namespace App\Repositories;

use App\Models\Page;
use App\Repositories\Interfaces\PageRepositoryInterface;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return Page::class;
    }
}
