<?php
namespace App\Contracts;

interface PaymentGateway
{
    public function payRequest($amount);
    public function verify($amount, $authority);
}
