<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticateUser
{
    /**
     * Attempt to authenticate a user.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(array $credentials, bool $remember = false)
    {
        if (! Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
    }
}
