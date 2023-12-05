<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Services\V1\AuthService;
use App\Http\Requests\V1\RegisterRequest;
use App\Http\Requests\V1\EmailLoginRequest;

class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): Response
    {
        return $this->authService->register($request->validated());
    }

    public function emailLogin(EmailLoginRequest $request): Response
    {
        return $this->authService->emailLogin($request->validated());
    }
}
