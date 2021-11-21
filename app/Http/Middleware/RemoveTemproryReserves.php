<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class RemoveTemproryReserves
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       Reservation::where('is_reserved', false)->where('created_at','<',Carbon::now()->subMinutes(15))->delete();
        return $next($request);
    }
}
