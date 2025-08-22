<?php

namespace App\Repositories\Interfaces;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface DepositTransactionRepositoryInterface extends BaseRepositoryInterface
{
    public function find($id);
    public function findOrFail($id);

}
