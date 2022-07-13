<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(LoginRequest $request, AuthService $authService)
    {
        try{
            $userData = $authService->userLogin($request->validated());
            if($userData['status']){
                $authData = auth()->user()->only(['id','name']);
                $authData['accessToken'] = $userData['token'];
                return $this->sendJsonSuccessResponse('You are login', $authData);
            }
            return $this->sendJsonErrorResponse('Please enter correct password', $userData);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }

    }

    public function logout()
    {
        request()->user()->currentAccessToken()->delete();
        return $this->sendJsonSuccessResponse('Logout successfully!');
    }
}
