<?php


namespace App\Http\Services;



class UserService
{
    /**
     * @param array $userData
     * @return array
     */
    public function updateUserData(array $userData)
    {
        request()->user()->update($userData);
        return $userData;
    }
}