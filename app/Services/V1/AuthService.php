<?php

namespace App\Services\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;

use App\Http\Resources\V1\User\UserResource;
use App\Repositories\V1\Auth\AuthRepositoryInterface;

class AuthService
{
    protected AuthRepositoryInterface $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository) {
        $this->authRepository = $authRepository;
    }

    public function register(array $data): Response
    {
        try {

            $user = $this->authRepository->register($data);
            event(new Registered($user));
            //$user->sendEmailVerificationNotification();

            return Response(['status' => 200, 
                            'response' => 'success', 
                            'messsage' => 'Please check your email for verification'
                        ], 200);

        } catch(\Exception $e) {
            return Response(['status' => 400, 
                'response' => $e->getMessage()
            ], 200);
        }
    }
}