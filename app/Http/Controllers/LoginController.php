<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;


class LoginController extends Controller
{
    public function login(Request $request)
    {

        $client = Client::where('password_client', 1)->firstOrFail();

        $response = Http::asform()->post(route('passport.token'), [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->email,
            'password' => $request->password,
        ]);

        return $response->json();
    }
}
