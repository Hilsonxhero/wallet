<?php


namespace Modules\User\App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Modules\User\App\resources\UserResource;
use Modules\User\App\Http\Requests\LoginRequest;
use Modules\Common\App\Http\Controllers\Api\ApiController;

class AuthenticatedSessionController extends ApiController
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
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
                return $this->successResponse([
                    'success' => true,
                    'user' => $user,
                    'token' => $token,
                ]);
            } else {
                return $this->successResponse([
                    'success' => false,
                ], "Password mismatch", 200);
            }
        } else {
            return $this->successResponse([
                'success' => false,
            ], "Unauthenticated", 200);
        }
    }

    public function init(Request $request)
    {
        return new UserResource(auth()->user());
    }


    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        auth()->user()->token()->revoke();

        $cookie = cookie()->forget('access_token');

        Cookie::queue(
            $cookie
        );
        return $this->successResponse([
            'message' => "Successfully logout",
            'success' => true,
        ]);
    }
}
