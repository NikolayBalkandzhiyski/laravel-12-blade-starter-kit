<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Auth\AuthenticateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actions\Auth\AuthenticateUser  $authenticateUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, AuthenticateUser $authenticateUser)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $authenticateUser->handle(
            $request->only('email', 'password'),
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
