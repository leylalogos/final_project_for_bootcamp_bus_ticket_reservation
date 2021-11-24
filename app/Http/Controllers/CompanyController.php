<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    public function index()
    {
        return CompanyResource::collection(User::where('role_id', User::USER_TYPE_COMPANY)->get());
    }
}
