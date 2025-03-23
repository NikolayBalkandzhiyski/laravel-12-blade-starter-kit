<?php

namespace Tests\Unit\Actions\Profile;

use App\Actions\Profile\UpdateUserPassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateUserPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_user_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('current-password'),
        ]);

        $updater = new UpdateUserPassword;

        $updater->handle($user, [
            'current_password' => 'current-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $this->assertTrue(Hash::check('new-password', $user->password));
    }

    /** @test */
    public function it_requires_current_password()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $user = User::factory()->create();

        $updater = new UpdateUserPassword;

        $updater->handle($user, [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);
    }
}
