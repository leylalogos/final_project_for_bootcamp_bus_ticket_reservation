<?php

namespace App\PaymentGateways;

use App\Contracts\PaymentGateway;
use Illuminate\Support\Facades\Http;

class ZarinPal implements PaymentGateway
{
    public function payRequest($amount,$callback_url)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/request.json', [
            'merchant_id' => env('MERCHANT_ID'),
            'amount' => $amount,
            'description' => 'تست',
            'callback_url' => $callback_url,
        ])->json()['data']['authority'];
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
