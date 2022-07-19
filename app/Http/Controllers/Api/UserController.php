<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_profile(UpdateRequest $request, UserService $userService)
    {
        try{
            $userService->updateUserData($request->except('email'));

            return $this->sendJsonSuccessResponse('Profile updated successfully');
        } catch(\Exception $ex) {
            return $this->sendJsonErrorResponse('Something went wrong');
        }
    }
}
