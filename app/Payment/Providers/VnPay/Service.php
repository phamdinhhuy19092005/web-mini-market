<?php

namespace App\Payment\Providers\VnPay;

use App\Enum\DepositStatusEnum;
use App\Payment\BasePaymentIntegration;
use App\Payment\Providers\VnPay\ProviderHandlers\HandlerHelper;

class Service extends BasePaymentIntegration
{
    public $handleClass;

    public const PROVIDER_NAME = 'VnPay';
    public const PROVIDER_CODE = 'vnpay';

    /**
     * Trả về class handler để xử lý giao dịch VNPay
     */
    public function getHandleClass($data = [])
    {
        // Bạn có thể tạo 1 class riêng để handle logic VNPay
        // Ví dụ: return new VnPayHandler($data);
        return new class($data) {
            protected $data;
            public function __construct($data) {
                $this->data = $data;
            }
            public function parsePayload($payload) {
                return $payload;
            }
        };

        // dd();
        if ($this->handleClass) {
            return $this->handleClass;
        }

        if (! $this->paymentOption) {
            throw new \Exception('Unable to get handle class for provider '.self::PROVIDER_CODE.' due to invalid payment option.');
        }

        // dd(HandlerHelper::routingHandleClassByIntegrationService($this));

        $handlerClass = HandlerHelper::routingHandleClassByIntegrationService($this);

        if (! $handlerClass) {
            throw new \Exception('Unable to resolve handler class for VNPay');
        }

        $this->handleClass = $this->resolveHandleClass($handlerClass);

        return $this->handleClass;
    }

    /**
     * Xử lý transaction (ghi nhận kết quả, update DB, ...)
     */
   public function handleTransaction($transaction, $data = [])
    {
        $transaction->status = DepositStatusEnum::APPROVED; 
        $transaction->save();

        return $transaction;
    }

    public function getVnPayProvider()
    {
        return $this->paymentOption->online_banking_code;
    }

    /**
     * Kiểm tra provider này có hoạt động không
     */
    public function isActive(): bool
    {
        return (bool) config('payment.vnpay.enabled', true);
    }

    /**
     * Tạo URL thanh toán
     */
    public function createPaymentUrl(array $params): string
    {
        return 'https://sandbox.vnpayment.vn/payment/?' . http_build_query($params);
    }

    /**
     * Xử lý callback từ VNPay
     */
    public function handleCallback(array $requestData): array
    {
        return [
            'status' => $requestData['vnp_ResponseCode'] == '00' ? 'success' : 'failed',
            'transaction_id' => $requestData['vnp_TxnRef'] ?? null,
            'amount' => $requestData['vnp_Amount'] ?? null,
        ];
    }
}
