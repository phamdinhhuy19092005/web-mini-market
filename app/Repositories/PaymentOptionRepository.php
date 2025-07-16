<?php
namespace App\Repositories;

use App\Models\PaymentOption;
use App\Repositories\Interfaces\PaymentOptionRepositoryInterface;

class PaymentOptionRepository extends BaseRepository implements PaymentOptionRepositoryInterface
{
    public function model(): string
    {
        return PaymentOption::class;
    }
}
