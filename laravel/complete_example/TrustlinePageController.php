<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TrustlinePageController extends Controller
{
    public function form()
    {
        return view('pay');  //your pay blade 
    }

    public function send(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:40',
            'phone_number' => 'required',
            'network_code' => 'required',
        ]);

        $payload = [
            'external_reference' => 'webform-' . uniqid(),
            'amount' => $request->amount,
            'phone_number' => $request->phone_number,
            'network_code' => $request->network_code,
            'channel' => 'mobile',
            'channel_id' => 1768,
            'payment_service' => 'b2c',
            'callback_url' => 'https://yourdomain.com/api/trustline_callback',  //REPLACE THIS WITH YOUR ACTUAL domain
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Basic PASTE_YOUR_TOKEN_HERE',  //REPLACE PASTE_YOUR_TOKEN_HERE WITH TOKEN FROM YOUR ACCOUNT
            'Content-Type' => 'application/json'
        ])->post('https://trustline.co.ke/api/v1/pay', $payload);


        return back()->with('response', $response->json());
    }
}
