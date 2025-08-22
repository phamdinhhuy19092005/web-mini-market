<?php

namespace App\Payment;

use App\Models\PaymentProvider;
use App\Models\PaymentOption;
use App\Services\PaymentOptionService;

/**
 * Base payment integration class
 * All providers (e.g. VnPay, Momo) must extend this class.
 */
abstract class BasePaymentIntegration
{
    /**
     * @var PaymentProvider
     */
    public $provider;

    /**
     * @var PaymentOption
     */
    public $paymentOption;

    public function __construct(PaymentOptionService $paymentOptionService, $paymentOption = null)
    {
        $this->paymentOption = $paymentOption;
        $this->provider = optional($this->paymentOption)->paymentProvider;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Return the handler class for processing payments
     */
    public abstract function getHandleClass($data = []);

    /**
     * Handle the transaction logic
     */
    public abstract function handleTransaction($transaction, $data = []);

    /**
     * parse data before save transaction
     * @param array $data
     * @return array
     */
    public function parsePayload($data = []): array
    {
        $parsed = $this->getHandleClass($data)->parsePayload($data);

        // return $parsed;
        return [];
    }

    public function isDepositTransaction()
    {
        return $this->getProvider()->isDeposit();
    }

    public function resolveHandleClass(string $handleClass)
    {
        $handleClass = app($handleClass, [
            'service' => $this
        ]);

        if (! $handleClass instanceof BasePaymentProviderHandle) {
            throw new \Exception("The handle class $handleClass must be instance of ". BasePaymentProviderHandle::class);
        }

        return $handleClass;
    }
}
