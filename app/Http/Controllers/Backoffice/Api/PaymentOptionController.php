<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListPaymentOptionResponseContract;
use App\Services\PaymentOptionService;
use Illuminate\Http\Request;

class PaymentOptionController extends BaseApiController
{
    public function __construct(protected PaymentOptionService $paymentOptionService){}

    public function index(Request $request)
    {
        $payment_options = $this->paymentOptionService->searchByAdmin($request->all());

        return $this->responses(ListPaymentOptionResponseContract::class, $payment_options);
    }
}
