<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Bus;
use App\Models\Trip;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(5));
        Passport::refreshTokensExpireIn(now()->addDays(30));


        Gate::define('create-bus', function (User $user) {
            return  $user->role_id != 4;
        });
        Gate::define('deleteAndUpdateBus', function (User $user, Bus $bus) {
            if ($user->role_id == 3) {
                return  ($user->id == $bus->user_id);
            }
            return $user->role_id != 4;
        });
    }
}
