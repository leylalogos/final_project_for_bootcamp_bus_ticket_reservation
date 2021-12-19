<?php

namespace App\PaymentGateways;

use App\Contracts\PaymentGateway;
use Illuminate\Support\Facades\Http;

class ZarinPal implements PaymentGateway
{
    public function payRequest($amount)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/request.json', [
            'merchant_id' => env('MERCHANT_ID'),
            'amount' => $amount,
            'description' => 'تست',
            'callback_url' => route('payment.verify', ['trip' => $trip]),
        ])->json();
    }
    public function verify($amount, $authority)
    {
       return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/verify.json', [
            'merchant_id' => env('MERCHANT_ID'),
            'amount' => $amount,
            'authority' => $authority
        ])->json();
    }
}
