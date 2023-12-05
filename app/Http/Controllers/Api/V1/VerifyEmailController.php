<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Verified;

use App\Models\User;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::find($request->route('id'));
        
        if($user->hasVerifiedEmail()) return Response(['status' => 400, 'response' => 'Bad Request', 'message' => 'Email is already verified'], 400);

        if($user->markEmailAsVerified()) event(new Verified($user));

        return Response(['status' => 200, 'response' => 'ok', 'message' => 'verification successfull.'], 200);
    }
}
