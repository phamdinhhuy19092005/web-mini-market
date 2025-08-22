<?php

namespace App\Payment\Providers\VnPay\ProviderHandlers;

use App\Enum\PaymentTypeEnum;
use App\Exceptions\PaymentIntegrationException;
use App\Models\BaseModel;
use App\Payment\BasePaymentProviderHandle;
use App\Payment\PaymentIntegrationService;
use App\Payment\Providers\VnPay\Constants\PaymentChannel;
use App\Payment\Providers\VnPay\Service;
use App\Services\PaymentOptionService;

class HandlerHelper
{
    public static function routingHandleClassByIntegrationService(Service $integrationService)
    {
        $vnpayProvider = $integrationService->getVnPayProvider();

        if ($integrationService->isDepositTransaction()) {
            switch ($vnpayProvider) {
                case PaymentChannel::VNPAYQR:
                    return Deposit\VnPayqr::class;
                case PaymentChannel::INTCARD:
                    return Deposit\IntCard::class;
                case PaymentChannel::VNBANK:
                    return Deposit\VnBank::class;
                case PaymentChannel::E_WALLET:
                    return Deposit\EWallet::class;
                default:
                    throw new \Exception('Invalid Payment Channel.');
            }
        }
    }
}
