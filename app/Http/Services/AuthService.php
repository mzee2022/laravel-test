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
    public function userLogin(array $loginRequest)
    {
        $authUser = Auth::attempt(['email' => $loginRequest['email'], 'password' => $loginRequest['password']]);
        if($authUser){
            $userData['token'] = auth()->user()->createToken('API Token')->plainTextToken;
        }
        $userData['status'] = $authUser;

        return $userData;
    }
}