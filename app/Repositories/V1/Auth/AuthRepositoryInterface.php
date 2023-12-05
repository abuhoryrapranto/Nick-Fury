<?php

namespace App\Repositories\V1\Auth;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function emailLogin(string $email);
}