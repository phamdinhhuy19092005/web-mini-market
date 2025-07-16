<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StorePaymentOptionResponseContract;
use App\Contracts\Responses\Backoffice\UpdatePaymentOptionResponseContract;
use App\Enum\PaymentOptionTypeEnum;
use App\Enum\PaymentTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StorePaymentOptionRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdatePaymentOptionRequestInterface;
use App\Models\Country;
use App\Services\PaymentOptionService;
use App\Services\PaymentProviderService;

class PaymentOptionController extends BaseController
{
    protected $paymentOptionService;
    public $paymentProviderService;

    public function __construct(PaymentOptionService $paymentOptionService, PaymentProviderService $paymentProviderService )
    {
        $this->paymentOptionService = $paymentOptionService;
        $this->paymentProviderService = $paymentProviderService;
    }

    public function index()
    {
        return view('backoffice.pages.payment-options.index');
    }

    public function create()
    {
        $paymentProviders = $this->paymentProviderService->getProviderByType(PaymentTypeEnum::DEPOSIT);
        $paymentOptionTypeEnumLabels = PaymentOptionTypeEnum::labels();
        $countries = Country::whereNotNull('currency')->select('currency', 'currency_name')->groupBy('currency', 'currency_name')->get();
        return view('backoffice.pages.payment-options.create', compact('paymentProviders','paymentOptionTypeEnumLabels', 'countries'));
    }

    public function store(StorePaymentOptionRequestInterface $request)
    {
        $payment_provider = $this->paymentOptionService->create($request->validated());
        return $this->responses(StorePaymentOptionResponseContract::class, $payment_provider);
    }

    public function show($id)
    {
        $payment_option = $this->paymentOptionService->show($id);
        $paymentProviders = $this->paymentProviderService->getProviderByType(PaymentTypeEnum::DEPOSIT);
        $paymentOptionTypeEnumLabels = PaymentOptionTypeEnum::labels();
        $countries = Country::whereNotNull('currency')->select('currency', 'currency_name')->groupBy('currency', 'currency_name')->get();
        return view('backoffice.pages.payment-options.edit', compact('payment_option','paymentProviders','paymentOptionTypeEnumLabels', 'countries'));
    }

    public function edit($id)
    {
        $payment_option = $this->paymentOptionService->show($id);
        $paymentProviders = $this->paymentProviderService->getProviderByType(PaymentTypeEnum::DEPOSIT);
        $paymentOptionTypeEnumLabels = PaymentOptionTypeEnum::labels();
        $countries = Country::whereNotNull('currency')->select('currency', 'currency_name')->groupBy('currency', 'currency_name')->get();
        return view('backoffice.pages.payment-options.edit', compact('payment_option','paymentProviders','paymentOptionTypeEnumLabels', 'countries'));
    }

    public function update(UpdatePaymentOptionRequestInterface $request, string $id)
    {
        $payment_option = $this->paymentOptionService->update($id, $request->validated());
        return $this->responses(UpdatePaymentOptionResponseContract::class, $payment_option);
    }

    public function destroy(string $id)
    {
        $this->paymentOptionService->delete($id);
        return redirect()->route('backoffice.pages.payment-options.index');
    }

}
