<?php

namespace Tests\Unit\Actions\Profile;

use App\Actions\Profile\UpdateProfileInformation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_profile_information()
    {
        $user = User::factory()->create();

        $updater = new UpdateProfileInformation;

        $updater->handle($user, [
            'name' => 'Test Updated',
            'email' => 'updated@example.com',
        ]);

        $this->assertEquals('Test Updated', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
    }

    /** @test */
    public function it_requires_a_unique_email()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $updater = new UpdateProfileInformation;

        $updater->handle($user1, [
            'name' => 'Test User',
            'email' => $user2->email,
        ]);
    }
}
