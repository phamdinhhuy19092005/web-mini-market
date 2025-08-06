<?php

return [
    'endpoints' => [
        'deposit' => '/paymentv2/vpcpay.html',
    ],

    'vnp_locale' => 'vn',

    'credentials' => [
        'vnp_tmn_code' => env('VNPAY_TMN_CODE', ''),
        'vnp_hash_secret' => env('VNPAY_HASH_SECRET', ''),
    ],

    'vnp_command' => 'pay',

    'vnp_version' => '2.1.0',

    'base_api_url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn'),

    'payment_channel' => [
        'e-wallet' => [
            'vnbank' => 'VN Bank',
            'intcard' => 'Int Card',
            'vnpayqr' => 'VNPay QR',
        ],
    ],

    'transaction_prefix' => 'NenUudam_',

    'default_currency_code' => 'VND',

    'deposit_expires_in_min' => 10,

    'return_url' => env('VNPAY_RETURN_URL'),
    'ipn_url' => env('VNPAY_IPN_URL'),
];
