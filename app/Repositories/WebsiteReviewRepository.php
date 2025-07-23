<?php
namespace App\Repositories;

use App\Models\WebsiteReview;
use App\Repositories\Interfaces\WebsiteReviewRepositoryInterface;

class WebsiteReviewRepository extends BaseRepository implements WebsiteReviewRepositoryInterface
{
    /**
     * Trả về tên lớp của model.
     *
     * @return string
     */
    public function model(): string
    {
        return WebsiteReview::class;
    }
}
