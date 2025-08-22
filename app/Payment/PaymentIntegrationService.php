<?php

namespace App\Payment;

use App\Services\PaymentOptionService;

class PaymentIntegrationService
{
    public function resolveServiceClassByPaymentOption($paymentOption)
    {
        $paymentOption = PaymentOptionService::make()->show($paymentOption);

        $paymentProvider = $paymentOption->paymentProvider;

        if(! ($paymentOption->isThirdParty()) && $paymentProvider)
        {
            throw new \Exception('Invalid payment option.'); 
        }

        if (! $paymentProvider || ! $paymentProvider->isActive()) {
            throw new \Exception("resolveProvider: payment provider {$paymentProvider->code} is not activated"); 
        }

        $paymentProviderMappers = config('payment.payment_provider_mappers', []);

        $providerClass = data_get($paymentProviderMappers, $paymentProvider->code, null);

        if (! class_exists($providerClass)) {
            throw new \Exception("Unknown payment provider: {$paymentProvider->code}");
        }

        $providerInstance = app($providerClass, ['paymentOption' => $paymentOption]);

        if (! $providerInstance instanceof BasePaymentIntegration) {
            throw new \Exception("Class $providerClass must be an instance of ".BasePaymentIntegration::class);
        }

        return $providerInstance;
    }

    
}

