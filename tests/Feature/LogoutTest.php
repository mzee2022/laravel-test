<?php

namespace Tests\Feature;

use App\Http\Services\TestCases\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_logout()
    {
        $authService = App::make(AuthService::class);
        $this->json('GET', 'api/logout', ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()])
            ->assertStatus(200)
            ->assertJsonStructure();
    }
}
