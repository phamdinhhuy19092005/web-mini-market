<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StorePaymentProviderResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePaymentProviderResponseContract;
use App\Enum\ActivationStatusEnum;
use App\Enum\PaymentTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StorePaymentProviderRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePaymentProviderRequestInterface;
use App\Models\PaymentProvider;
use App\Services\PaymentProviderService;

class PaymentProviderController extends BaseController
{
    protected $paymentProviderService;

    public function __construct(PaymentProviderService $paymentProviderService)
    {
        $this->paymentProviderService = $paymentProviderService;
    }

    public function index()
    {
        return view('backoffice.pages.payment-providers.index');
    }

    public function create()
    {
        $providers = PaymentProvider::where('status', 1)->get();
        $paymentTypeEnumLabels = PaymentTypeEnum::labels();
        return view('backoffice.pages.payment-providers.create', compact('providers','paymentTypeEnumLabels'));
    }

    public function store(StorePaymentProviderRequestInterface $request)
    {
        $payment_provider = $this->paymentProviderService->create($request->validated());
        return $this->responses(StorePaymentProviderResponseContract::class, $payment_provider);
    }

    public function show($id)
    {
        $payment_provider = $this->paymentProviderService->show($id);
        $providers = PaymentProvider::where('status', 1)->get();
        $paymentTypeEnumLabels = PaymentTypeEnum::labels();
        return view('backoffice.pages.payment-providers.edit', compact('payment_provider', 'providers', 'paymentTypeEnumLabels'));
    }

    public function edit($id)
    {
        $payment_provider = $this->paymentProviderService->show($id);
        $providers = PaymentProvider::where('status', 1)->get();
        $paymentTypeEnumLabels = PaymentTypeEnum::labels();
        return view('backoffice.pages.payment-providers.edit', compact('payment_provider', 'providers', 'paymentTypeEnumLabels'));
    }

    public function update(UpdatePaymentProviderRequestInterface $request, string $id)
    {
        $payment_provider = $this->paymentProviderService->update($id, $request->validated());
        return $this->responses(UpdatePaymentProviderResponseContract::class, $payment_provider);
    }

    public function destroy(string $id)
    {
        $this->paymentProviderService->delete($id);
        return redirect()->route('backoffice.pages.payment-providers.index');
    }

}
