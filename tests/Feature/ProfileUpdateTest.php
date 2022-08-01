<?php

namespace Tests\Feature;

use App\Http\Services\TestCases\AuthService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $authService = App::make(AuthService::class);
        $userUpdatedData = ['name'=> $this->faker->name];

        $this->json('POST', 'api/update_profile', $userUpdatedData, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()])
            ->assertStatus(200)
            ->assertJsonStructure();
    }
}

