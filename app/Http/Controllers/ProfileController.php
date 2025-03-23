<?php

namespace App\Http\Controllers;

use App\Actions\Profile\DeleteUser;
use App\Actions\Profile\UpdateProfileInformation;
use App\Actions\Profile\UpdateUserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, UpdateProfileInformation $updater)
    {
        $updater->handle($request->user(), $request->all());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function password(Request $request, UpdateUserPassword $updater)
    {
        $updater->handle($request->user(), $request->all());

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, DeleteUser $deleter)
    {
        $request->validateWithBag('deleteUser', [
            'password' => ['required'],
        ]);

        $deleter->handle($request->user(), $request->password);

        return Redirect::to('/');
    }
}
