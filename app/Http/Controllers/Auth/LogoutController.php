<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Auth\LogoutUser;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actions\Auth\LogoutUser  $logoutUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, LogoutUser $logoutUser)
    {
        $logoutUser->handle($request);

        return redirect('/');
    }
}
