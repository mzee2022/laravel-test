<?php
namespace App\Http\Services\TestCases;

use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param LoginRequest $loginRequest
     * @return void
     */
    public function getLoggedInToken()
    {
        Auth::attempt(['email' => 'admin@gmail.com', 'password' => '12345678']);

        return auth()->user()->createToken('API Token')->plainTextToken;
    }
}