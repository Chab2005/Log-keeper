<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create($validated);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [], [
            'login' => 'username or email',
        ]);

        $field = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attempted = Auth::attempt([
            $field => $validated['login'],
            'password' => $validated['password'],
        ]);

        if (! $attempted) {
            throw ValidationException::withMessages([
                'login' => 'These credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
