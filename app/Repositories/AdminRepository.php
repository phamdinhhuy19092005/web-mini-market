<?php
namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Admin::class;
    }
}
