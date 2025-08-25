<?php

return [
    'tmn_code' => env('VNPAY_TMN_CODE', ''),
    'hash_secret' => env('VNPAY_HASH_SECRET', ''),
    'url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'return_url' => env('VNPAY_RETURN_URL', 'http://127.0.0.1:8000/api/payment/return'),
    'command' => 'pay',
    'locale' => 'vn',
    'currency' => 'VND',
    'version' => '2.1.0',
];
