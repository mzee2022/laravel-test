<?php

namespace Tests\Feature\Todo;

use App\Http\Services\TestCases\AuthService;
use App\Models\Todo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AllTodoTest extends TestCase
{
    use WithFaker;

    /**
     * @return array
     */
    public function getHeaders() {
        $authService = App::make(AuthService::class);

        return ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $authService->getLoggedInToken()];
    }

    /**
     * @return void
     */
    public function test_listing_todo()
    {
        $this->json('GET', 'api/todo', $this->getHeaders())
            ->assertStatus(200)
            ->assertJsonStructure();
    }

    /**
     * @return void
     */
    public function test_add_todo()
    {
        $this->json('POST', 'api/todo', $this->getTodoData(), $this->getHeaders())
            ->assertStatus(200)
            ->assertJsonStructure();

    }

    /**
     * @return void
     */
    public function test_display_todo()
    {
        $this->json('GET', 'api/todo/' . $this->getLatestTodoId(), $this->getHeaders())
            ->assertStatus(200)
            ->assertJsonStructure(['status']);
    }

    /**
     * @return void
     */
    public function test_update_todo()
    {

        $this->json('PUT', 'api/todo/' . $this->getLatestTodoId(), $this->getTodoData(), $this->getHeaders())
            ->assertStatus(200)
            ->assertJsonStructure();
    }

    /**
     * @return void
     */
    public function test_delete_todo()
    {
        $this->json('DELETE', 'api/todo/' . $this->getLatestTodoId(), $this->getHeaders())
            ->assertStatus(200)
            ->assertJsonStructure();
    }

    /**
     * @return array
     */
    public function getTodoData() {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'status' => $this->faker->boolean,
        ];
    }

    /**
     * @return mixed
     */
    public function getLatestTodoId() {
        return Todo::latest()->first()->id;
    }
}
