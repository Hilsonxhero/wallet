<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mockery\Undefined;
use Symfony\Component\HttpFoundation\Response;

class AddAuthTokenHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookie_name = 'access_token';


        if (!$request->bearerToken()) {
            if ($request->hasCookie($cookie_name)) {
                $token = $request->cookie($cookie_name);
                $request->headers->add([
                    'Authorization' => 'Bearer ' . $token
                ]);
            }
        }

        return $next($request);
    }
}
