<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Payment;
use App\Models\Trip;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function pay(Request $request, Trip $trip)
    {

        $amount =  $trip->UserReservedTotalPrice;
        if ($request->has('debug')) {
            $amount = 1000;
        }

        $result = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/request.json', [
            'merchant_id' => '1344b5d4-0048-11e8-94db-005056a205be',
            'amount' => $amount,
            'description' => 'تست',
            'callback_url' => route('payment.verify', ['trip' => $trip]),
        ])->json();

        Payment::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'authority' => $result['data']['authority'],
        ]);
        $url = 'https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];

        return ($request->has('debug') ? $url : redirect($url));
    }


    public function verify(Trip $trip, Request $request)
    {
        $amount =  $trip->UserReservedTotalPrice;
        if ($request->has('debug')) {
            $amount = 1000;
        }

        $authority = $request->Authority;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/verify.json', [
            'merchant_id' => '1344b5d4-0048-11e8-94db-005056a205be',
            'amount' => $amount,
            'authority' => $authority
        ])->json();

        $payment = Payment::where('authority', $authority)->first();

        if (
            isset($response['data']) &&
            isset($response['data']['code']) &&
            ($response['data']['code'] == 100 || $response['data']['code'] == 101)
        ) {
            $payment->update([
                'ref_id' => $response["data"]['ref_id'],
                'success' => true
            ]);

            Reservation::where('user_id', auth()->id())
                ->where('trip_id', $trip->id)
                ->update([
                    'is_reserved' => true,
                    'payment_id' => $payment->id
                ]);

            return [
                'message' => 'payment was successful',
                'ref_id' => $response['data']['ref_id']
            ];
        } else {
            $payment->update(['success' => false]);

            return ['message' => 'payment was not successful'];
        }
    }
}
