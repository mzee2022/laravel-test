<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Services\AuthService;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function login(LoginRequest $request, AuthService $authService)
    {
        try{
            $userData = $authService->userLogin($request->validated());
            if($userData['status']){
                $authData = auth()->user()->only(['name','email']);
                $authData['accessToken'] = $userData['token'];
                return $this->sendJsonSuccessResponse('You are login', $authData);
            }
            return $this->sendJsonErrorResponse('Please enter correct password', $userData);
        } catch(\Exception $ex) {
            return $this->sendJsonErrorResponse('Something went wrong');
        }

    }

    public function logout()
    {
        request()->user()->tokens()->where('id', Str::before(request()->bearerToken(), '|') )->delete();
        return $this->sendJsonSuccessResponse('Logout successfully!');
    }
}
