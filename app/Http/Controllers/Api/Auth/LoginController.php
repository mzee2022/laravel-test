<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request, AuthService $authService) {
        dd($authService->userLogin($request->validated()));
    }
}
