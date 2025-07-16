<?php
namespace App\Repositories;

use App\Models\PaymentProvider;
use App\Repositories\Interfaces\PaymentProviderRepositoryInterface;

class PaymentProviderRepository extends BaseRepository implements PaymentProviderRepositoryInterface
{
    public function model(): string
    {
        return PaymentProvider::class;
    }
}
