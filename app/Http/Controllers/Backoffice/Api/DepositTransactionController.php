<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListDepositTransactionResponseContract;
use App\Services\DepositTransactionService;
use Illuminate\Http\Request;

class DepositTransactionController extends BaseApiController
{
    public function __construct(protected DepositTransactionService $depositTransactionsService)
    {
        //
    }

    public function index(Request $request)
    {
        $depositTransactions = $this->depositTransactionsService->searchByAdmin($request->all());

        return $this->responses(ListDepositTransactionResponseContract::class, $depositTransactions);
    }
}
