<?php

namespace App\Actions\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DeleteUser
{
    /**
     * Delete the given user.
     */
    public function handle(User $user, string $password): void
    {
        if (! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided password does not match your current password.'],
            ])->errorBag('deleteUser');
        }

        Auth::logout();

        $user->delete();
    }
}
