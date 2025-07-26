<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\DepositTransaction;

class DepositTransactionController extends BaseController
{
    /**
     * Hiển thị danh sách các giao dịch nạp tiền
     */
    public function index()
    {
        $transactions = DepositTransaction::latest()->paginate(20);

        return view('backoffice.pages.deposit-transactions.index', compact('transactions'));
    }

    /**
     * Hiển thị chi tiết một giao dịch nạp tiền
     */
    public function show($id)
    {
        $transaction = DepositTransaction::findOrFail($id);

        return view('backoffice.pages.deposit-transactions.show', compact('transaction'));
    }
}
