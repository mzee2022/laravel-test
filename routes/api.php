<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[ LoginController::class, 'login' ]);

Route::middleware('auth:sanctum')->group( function(Router $route) {
    $route->get('/logout',[ LoginController::class, 'logout' ]);
    $route->post('/update_profile', [ UserController::class, 'update_profile' ]);
    $route->apiResource('todo', TodoController::class);
});

