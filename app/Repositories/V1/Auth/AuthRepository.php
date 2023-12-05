<?php

namespace App\Repositories\V1\Auth;

use App\Repositories\V1\Auth\AuthRepositoryInterface;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data): User
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        return $user;
    }

    public function verifyEmailOTP(int $userId): User
    {

    }

    public function login(array $data): User
    {

    }
}