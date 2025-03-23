<?php

namespace Tests\Unit\Actions\Profile;

use App\Actions\Profile\DeleteUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_the_user()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $deleter = new DeleteUser;

        $deleter->handle($user, 'password');

        $this->assertNull($user->fresh());
    }

    /** @test */
    public function it_validates_password_before_deletion()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $user = User::factory()->create();

        $deleter = new DeleteUser;

        $deleter->handle($user, 'wrong-password');

        $this->assertNotNull($user->fresh());
    }
}
