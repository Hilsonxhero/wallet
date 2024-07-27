<?php


namespace Modules\User\App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Modules\User\App\Models\User;
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

    /**
     * Initialize the user session and return the authenticated user's details.
     *
     * @param Request $request The HTTP request object.
     * @return UserResource The resource containing the authenticated user's details.
     */
    public function init(Request $request)
    {
        return new UserResource(auth()->user());
    }


    /**
     * Destroy an authenticated token.
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
