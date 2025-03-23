<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Auth\RegisterUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actions\Auth\RegisterUser  $registerUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, RegisterUser $registerUser)
    {
        $user = $registerUser->handle($request->all());

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
