<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Services\AuthService;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, AuthService $authService)
    {
        try{
            $authUserData = $authService->userLogin($request->validated());
            if ($authUserData['status']) {
                return $this->sendJsonSuccessResponse('You are login', $authUserData);
            }
            return $this->sendJsonErrorResponse('Please enter correct password', $authUserData);
        } catch(\Exception $ex) {
            return $this->sendJsonErrorResponse('Something went wrong');
        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        request()->user()->tokens()->where('id', Str::before(request()->bearerToken(), '|') )->delete();
        return $this->sendJsonSuccessResponse('Logout successfully!');
    }
}
