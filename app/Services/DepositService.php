<?php

namespace App\Services;

use App\Common\Cache;
use App\Enum\DepositStatusEnum;
use App\Models\BaseModel;
use App\Services\BaseService;
use App\Exceptions\BusinessLogicException;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentOption;
use App\Models\User;
use App\Models\Order;
use App\Payment\BasePaymentIntegration;
use App\Payment\PaymentIntegrationService;
use Illuminate\Database\Eloquent\Model;

class DepositService extends BaseService
{
    public $depositTransactionService;
    public $paymentOptionService;
    public $userWalletService;
    public $userService;
    public $paymentIntegrationService;

    public $allowForceApproved = false;

    public function __construct(
        DepositTransactionService $depositTransactionService,
        PaymentOptionService $paymentOptionService,
        UserService $userService,
        PaymentIntegrationService $paymentIntegrationService
    ) {
        $this->depositTransactionService = $depositTransactionService;
        $this->paymentOptionService = $paymentOptionService;
        $this->userService = $userService;
        $this->paymentIntegrationService = $paymentIntegrationService;
    }

    public function deposit($userId, $amount, $paymentOptionId, $createdBy, $data = [])
    {
        /** @var User */
        $user = $this->userService->show($userId);
        
        /** @var PaymentOption */
        $paymentOption = $this->paymentOptionService->show($paymentOptionId);

        $paymentIntegrationService = null;

        if ($paymentOption->isThirdParty()) {
            $paymentIntegrationService = $this->paymentIntegrationService->resolveServiceClassByPaymentOption($paymentOption);
        }

        $order = OrderService::make()->find(data_get($data, 'order_id'));
        
        return DB::transaction(function() use ($user, $order, $amount, $paymentOption, $createdBy, $data, $paymentIntegrationService) {
            $currencyCode = data_get($data, 'currency_code');
            $log = data_get($data, 'log');
            $referenceId = data_get($data, 'reference_id');
            $orderId = $order->id;

            $meta = [
                'log' => $log,
                'reference_id' => $referenceId,
                'order_id' => $orderId
            ];

            if ($paymentOption->isThirdParty() && $paymentIntegrationService instanceof BasePaymentIntegration) {
                $meta['provider_payload'] = $paymentIntegrationService->parsePayload(array_merge($data, [
                    'user' => $user
                ]));
            }

            $bankTransferInfo = [];

            $depositTransaction = $this->depositTransactionService->createByUser(
                $user,
                $amount,
                $currencyCode,
                $paymentOption,
                $createdBy,
                $bankTransferInfo,
                $meta
            );

            // Payment provider - vpn,momo
            if ($paymentOption->isThirdParty() && $paymentIntegrationService instanceof BasePaymentIntegration) {
                return $paymentIntegrationService->handleTransaction($depositTransaction);
            }

            // COD
            return $depositTransaction;
        });
    }
}
