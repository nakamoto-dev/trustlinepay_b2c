<?php

// Simple PHP example to send a payment to TrustlinePay B2C API

$endpoint = 'https://trustline.co.ke/api/v1/pay';

$data = [
    'external_reference' => 'mpesa101',
    'amount' => 41,
    'phone_number' => '0112920153',
    'network_code' => 'safaricom',
    'channel' => 'mobile',
    'channel_id' => 1768,
    'payment_service' => 'b2c',
    'callback_url' => 'https://yourdomain.com/webhook'
];

$username = 'your_username';
$password = 'your_password';

$options = [
    CURLOPT_URL => $endpoint,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode("$username:$password")
    ]
];

$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo "cURL Error: $error";
} else {
    echo "Response: $response";
}
