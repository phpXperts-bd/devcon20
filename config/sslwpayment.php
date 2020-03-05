<?php

return [
    'store_id' => env('SSLWPAYMENT_STORE_ID',''),
    'store_password' => env('SSLWPAYMENT_STORE_PASSWORD',''),
    'sandbox' => env('SSLWPAYMENT_SANDBOX', true),
    'redirect_url' => [
        'fail' => [
            'url' => env('SSLWPAYMENT_FAILED_URL') // payment.failed
        ],
        'success' => [
            'url' => env('SSLWPAYMENT_SUCCESS_URL','') //payment.success
        ],
        'cancel' => [
            'url' => env('SSLWPAYMENT_CANCEL_URL','') // payment/cancel or you can use route also
        ]
    ]
];
