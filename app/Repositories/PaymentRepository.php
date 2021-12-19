<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class PaymentRepository
{
    private $payment;

    public function setPayment($authority)
    {
        $this->payment = Payment::where('authority', $authority)->first();
    }

    public static function store($amount, $authority)
    {
        Payment::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'authority' => $authority,
        ]);
    }

    public function paymentSuccess($response, $trip)
    {
        try {
            DB::beginTransaction();
            $this->payment->update([
                'ref_id' => $response["data"]['ref_id'],
                'success' => true
            ]);

            Reservation::where('user_id', auth()->id())
                ->where('trip_id', $trip->id)
                ->update([
                    'is_reserved' => true,
                    'payment_id' => $this->payment->id
                ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
    public function paymentFailed()
    {
        $this->payment->update(['success' => false]);
    }
}
