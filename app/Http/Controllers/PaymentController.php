<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Contracts\PaymentGateway;
use App\Repositories\PaymentRepository;



class PaymentController extends Controller
{
    public function pay(Trip $trip, PaymentGateway $paymentGateway)
    {
        $amount =  $trip->UserReservedTotalPrice;
        //debug
        $amount = 1000;
        //use paymentgatway serviseprovider
        $result = $paymentGateway->payRequest($amount);
        //use repository disign pattern
        PaymentRepository::store($amount, $result);
        $url = 'https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"];

        //debug for test
        return $url;
        //for production
        // return redirect($url);
    }

    public function verify(Trip $trip, Request $request, PaymentGateway $paymentGateway)
    {
        $amount =  $trip->UserReservedTotalPrice;
        //debug
        $amount = 1000;

        $authority = $request->Authority;
        $response = $paymentGateway->verify($amount, $authority);

        $payrepo = new PaymentRepository();
        $payrepo->setPayment($authority);

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
            $payrepo->paymentSuccess($response, $trip);


            //generate pdf
            $pdf = PDF::loadView('pdf', ['ticket' => $ticket]);
            $pdfPath = 'tickets/' . Str::random(40) . '.pdf';
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
