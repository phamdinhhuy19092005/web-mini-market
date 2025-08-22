<?php

return [
    'payment_provider_mappers' => [
        'vnpay' => \App\Payment\Providers\VnPay\Service::class,
    ],

    'vnpay' => [
        'enabled' => true,
        'tmn_code' => env('VNPAY_TMN_CODE'),
        'hash_secret' => env('VNPAY_HASH_SECRET'),
        'endpoint' => env('VNPAY_ENDPOINT', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    ],
];
