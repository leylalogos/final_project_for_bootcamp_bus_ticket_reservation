<?php

namespace App\Providers;

use App\Contracts\PaymentGateway;
use Illuminate\Support\ServiceProvider;
use App\PaymentGateways\ZarinPal;

class PaymentGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(PaymentGateway::class, ZarinPal::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
