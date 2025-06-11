<?php
namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Interfaces\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return Country::class;
    }
}
