<?php
namespace App\Contracts;

interface PaymentGateway
{
    public function payRequest($amount,$callback_url);
    public function verify($amount, $authority);
}
