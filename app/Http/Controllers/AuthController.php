<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login', ['title' => 'Log in']);
    }

    public function showRegister(): View
    {
        return view('auth.register', ['title' => 'Register']);
    }
}
