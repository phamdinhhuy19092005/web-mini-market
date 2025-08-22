<?php

namespace App\Repositories;

use App\Models\DepositTransaction;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\DepositTransactionRepositoryInterface;

class DepositTransactionRepository extends BaseRepository implements DepositTransactionRepositoryInterface
{
    public function model(): string
    {
        return DepositTransaction::class;
    }
}
