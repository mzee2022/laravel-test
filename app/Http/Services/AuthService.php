<?php


namespace App\Http\Services;


use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param LoginRequest $loginRequest
     * @return array
     */
    public function userLogin(array $loginRequest): array
    {
        $uauthUser = Auth::attempt(['email' => $loginRequest['email'], 'password' => $loginRequest['password']]);
        dd($uauthUser);
    }
}