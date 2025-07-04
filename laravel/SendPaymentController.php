<?php

namespace App\Http\Controllers\Examples;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SendPaymentController extends Controller
{
    public function send()
    {
        $url = 'https://trustline.co.ke/api/v1/pay';

        $payload = [
            'external_reference' => 'mpesa101',
            'amount' => 41,
            'phone_number' => '0112920153',
            'network_code' => 'safaricom',
            'channel' => 'mobile',
            'channel_id' => 1768,
            'payment_service' => 'b2c',
            'callback_url' => 'https://yourdomain.com/webhook'
        ];

        $response = Http::withBasicAuth('your_username', 'your_password')
                        ->post($url, $payload);

        return $response->json();
    }

    public function handleCallback(Request $request)
    {
        Log::info('Trustline callback received:', $request->all());

        return response()->json(['received' => true], 200);
    }
}
