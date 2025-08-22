<?php

namespace App\Services;

use App\Enum\DepositStatusEnum;
use App\Models\BaseModel;
use App\Repositories\Interfaces\DepositTransactionRepositoryInterface;
use App\Services\PaymentOptionService;
use App\Services\UserService;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class DepositTransactionService extends BaseService
{
    public $depositTransactionRepository;
    public $paymentOptionService;
    public $orderService;
    public $userService;

    public function __construct(
        DepositTransactionRepositoryInterface $depositTransactionRepository,
        PaymentOptionService $paymentOptionService,
        UserService $userService
    ) {
        $this->depositTransactionRepository = $depositTransactionRepository;
        $this->paymentOptionService = $paymentOptionService;
        $this->userService = $userService;
    }

    public function show($id)
    {
        return $this->depositTransactionRepository->findOrFail($id);
    }

    public function find($id)
    {
        return $this->depositTransactionRepository->find($id);
    }

    public function update($attributes, $id)
    {
        return $this->depositTransactionRepository->update($attributes, $id);
    }

    public function createByUser(
        $user,
        $amount,
        $currencyCode,
        $paymentOptionId,
        $createdBy,
        $bankTransferInfo = [],
        $meta = []
    ) {
        /** @var PaymentOption */
        $paymentOption = $this->paymentOptionService->show($paymentOptionId);

        /** @var User */
        $user = $this->userService->show($user);

        $amount = (float) $amount;

        if (! $createdBy instanceof Model) {
            throw new \Exception('Invalid Created By.');
        }

        $bankTransferInfo = array_filter($bankTransferInfo ?? []);

        $status = $paymentOption->isCOD() ? DepositStatusEnum::WAIT_FOR_CONFIRMATION : DepositStatusEnum::PENDING;

        $depositTransaction = $this->depositTransactionRepository->create(
            array_merge([
                'user_id' => $user->getKey(),
                'uuid' => (string) Str::uuid(),
                'amount' => (string) $amount,
                'status' => $status,
                'payment_option_id' => $paymentOption->getKey(),
                'currency_code' => $currencyCode,
            ],
            array_filter(['bank_transfer_info' => $bankTransferInfo]),
            BaseModel::getMorphProperty('created_by', $createdBy),
            BaseModel::getMorphProperty('updated_by', $createdBy),
            $meta
        ));

        return $depositTransaction;
    }
}
