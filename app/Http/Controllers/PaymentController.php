<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Contracts\PaymentGateway;
use Barryvdh\DomPDF\Facade as PDF;
use App\Repositories\PaymentRepository;

class PaymentController extends Controller
{
    public function pay(Trip $trip, PaymentGateway $paymentGateway)
    {
        //use accessor for amount
        $amount =  $trip->UserReservedTotalPrice;
        //debug
        $amount = 1000;
        //use paymentgatway serviseprovider
        $authority = $paymentGateway->payRequest($amount, route('payment.verify', ['trip' => $trip]));
        //use repository disign pattern
        PaymentRepository::store($amount, $authority);
        $url = 'https://www.zarinpal.com/pg/StartPay/' . $authority;

        //debug for test
        return $url;
        //for production
        // return redirect($url);
    }

    public function verify(Trip $trip, Request $request, PaymentGateway $paymentGateway)
    {
        //use accessor for amount
        $amount =  $trip->UserReservedTotalPrice;
        //debug
        $amount = 1000;
        $authority = $request->Authority;
        //use service provider paymentGateway
        $response = $paymentGateway->verify($amount, $authority);
        //use repository design patterns
        $payrepo = new PaymentRepository();
        $payrepo->setPayment($authority);

        if (
            isset($response['data']) &&
            isset($response['data']['code']) &&
            ($response['data']['code'] == 100 || $response['data']['code'] == 101)
        ) {
            //use repository design pattern
            $payrepo->paymentSuccess($response, $trip);

            return $this->showTicket($trip, $response['data']['ref_id']);
        } else {
            //use repository design pattern
            $payrepo->paymentFailed();

            return ['message' => 'payment was not successful'];
        }
    }

    private function generatePdf($ticket)
    {
        $pdf = PDF::loadView('pdf', ['ticket' => $ticket]);
        $pdfPath = 'tickets/' . Str::random(40) . '.pdf';
        $pdf->save(public_path($pdfPath));

        return $pdfPath;
    }

    private function showTicket($trip, $ref_id)
    {
        $ticket = [
            'name' => auth()->user()->name,
            'price' => $trip->UserReservedTotalPrice,
            'passenger_count' => $trip->userReservedSeatCount,
            'origin' => $trip->from->name,
            'destination' => $trip->to->name,
            'departure_time' => $trip->departure_time,
            'bus_company_name' => $trip->bus->user->name,
        ];
        return [
            'message' => 'payment was successful',
            'ref_id' => $ref_id,
            'ticket' => $ticket,
            'pdf_file' => $this->generatePdf($ticket)
        ];
    }
}
