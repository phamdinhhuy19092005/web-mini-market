<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListPaymentProviderResponseContract;
use App\Services\PaymentProviderService;
use Illuminate\Http\Request;

class PaymentProviderController extends BaseApiController
{
    public function __construct(protected PaymentProviderService $paymentProviderService){}

    public function index(Request $request)
    {
        $payment_providers = $this->paymentProviderService->searchByAdmin($request->all());

        return $this->responses(ListPaymentProviderResponseContract::class, $payment_providers);
    }
}
