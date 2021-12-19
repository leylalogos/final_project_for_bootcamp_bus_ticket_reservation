<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Http;
use App\Repositories\PaymentRepository;


class PaymentController extends Controller
{
    public function pay(Trip $trip)
    {
        $amount =  $trip->UserReservedTotalPrice;
        //debug
        $amount = 1000;

        $result = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/request.json', [
            'merchant_id' => env('MERCHANT_ID'),
            'amount' => $amount,
            'description' => 'تست',
            'callback_url' => route('payment.verify', ['trip' => $trip]),
        ])->json();

        PaymentRepository::store($amount,$result);
        $url = 'https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];

        //debug for test
        return $url;
        //for production
        // return redirect($url);
    }

    public function verify(Trip $trip, Request $request)
    {
        $amount =  $trip->UserReservedTotalPrice;
        //debug
        $amount = 1000;

        $authority = $request->Authority;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'ZarinPal Rest Api v4'
        ])->post('https://api.zarinpal.com/pg/v4/payment/verify.json', [
            'merchant_id' => env('MERCHANT_ID'),
            'amount' => $amount,
            'authority' => $authority
        ])->json();
//use transaction
            $payrepo = new PaymentRepository();
            $payrepo->setPayment($authority);
       // $payment = Payment::where('authority', $authority)->first();

        if (
            isset($response['data']) &&
            isset($response['data']['code']) &&
            ($response['data']['code'] == 100 || $response['data']['code'] == 101)
        ) {
            $ticket = [
                'name' => auth()->user()->name,
                'price' => $trip->UserReservedTotalPrice,
                'passenger_count' => $trip->userReservedSeatCount,
                'origin' => $trip->from->name,
                'destination' => $trip->to->name,
                'departure_time' => $trip->departure_time,
                'bus_company_name' => $trip->bus->user->name,
            ];
            $payrepo->paymentSuccess($response,$trip);
           

                //generate pdf
            $pdf = PDF::loadView('pdf', ['ticket' => $ticket]);
            $pdfPath = 'tickets/'.Str::random(40).'.pdf';
            $pdf->save(public_path($pdfPath));

            return [
                'message' => 'payment was successful',
                'ref_id' => $response['data']['ref_id'],
                'ticket' => $ticket,
                'file' => $pdfPath
            ];
        } else {
            
            $payrepo->paymentFailed();
            return ['message' => 'payment was not successful'];
        }
    }
}
