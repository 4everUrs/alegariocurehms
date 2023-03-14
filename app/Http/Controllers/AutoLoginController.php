<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutoLoginController extends Controller
{
    public function login()
    {
        $user = User::latest()->first();
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
