<?php

namespace Tests\Feature\Todo;

use App\Http\Services\TestCases\AuthService;
use App\Models\Todo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_listing_todo()
    {
        $authService = App::make(AuthService::class);
        $this->json('GET', 'api/todo', ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()])
            ->assertStatus(200)
            ->assertJsonStructure();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_todo()
    {
        $authService = App::make(AuthService::class);
        $todoData = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];

        $this->json('POST', 'api/todo', $todoData, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()])
            ->assertStatus(200)
            ->assertJsonStructure();

    }

    /**
     *
     */
    public function test_display_todo()
    {
        $authService = App::make(AuthService::class);
        $todo = Todo::first();

        $this->json('GET', 'api/todo/' . $todo->id,
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $authService->getLoggedInToken()
            ]
        )->assertStatus(200)
            ->assertJsonStructure(['status']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_todo()
    {
        $authService = App::make(AuthService::class);
        $todo = Todo::first();

        $todoData = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];

        $this->json('PUT', 'api/todo/' . $todo->id, $todoData, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()])
            ->assertStatus(200)
            ->assertJsonStructure();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_todo()
    {
        $authService = App::make(AuthService::class);
        $todo = Todo::first();

        $this->json('DELETE', 'api/todo/' . $todo->id, ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()])
            ->assertStatus(200)
            ->assertJsonStructure();
    }
}
