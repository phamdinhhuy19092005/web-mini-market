<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\DepositTransaction;
use Illuminate\Http\Request;

class DepositTransactionController extends BaseController
{
    public function index()
    {
        $transactions = DepositTransaction::latest()->paginate(20);

        return view('backoffice.deposit-transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = DepositTransaction::findOrFail($id);

        return view('backoffice.deposit-transactions.show', compact('transaction'));
    }
}
