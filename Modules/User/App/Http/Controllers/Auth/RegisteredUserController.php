<?php

namespace Modules\User\App\Http\Controllers\Auth;

use Modules\User\App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Modules\User\App\Http\Requests\RegisterRequest;
use Modules\Common\App\Http\Controllers\Api\ApiController;

class RegisteredUserController extends ApiController
{


    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));


        $token = $user->createToken('accessToken')->accessToken;


        Cookie::queue(
            'access_token',
            $token,
            45000,
            null,
            null,
            false,
            true,
            false,
            'Strict'
        );

        $request->headers->add([
            'Authorization' => 'Bearer ' . $token
        ]);
        return  $this->successResponse([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
