<?php

namespace App\Services\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

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

    public function emailLogin(array $data): Response
    {
        try {

            $user = $this->authRepository->emailLogin($data['email']);
            if(!Hash::check($data['password'], $user->password)) return Response(['status' => 400, 'response' => 'Bad Request', 'message' => "Password doesn't match"], 400);

            $token = $user->createToken('user-token');
            $plainToken = $token->plainTextToken;

            return Response([
                'message' => 'User login successfully.',
                'token' => $plainToken,
                'data' => new UserResource($user)
            ], 200);


        } catch(\Exception $e) {

            return Response(['status' => 500, 
                            'response' => 'Internal Server Error', 
                            'message' => $e->getMessage()
                        ], 500);
        }
    }
}