<?php

namespace App\Services;

class DepositService extends BaseService
{
    public $allowForceApproved = false;

    public function __construct() 
    {
        
    }

    public function deposit($userId, $amount, $paymentOptionId, $createdBy, $data = [])
    {
        /** @var User */
        // $user = $this->userService->show($userId);
    }
}
