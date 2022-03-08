<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthMiddleware
{

    public function handle($request, Closure $next)
    {

        try {
            $token = request()->bearerToken();
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            if ($decoded->nbf)
            return $next($request);
        }catch (Exception $e){
            return response()->json(['status'=>'error','message'=>'invalid token'],403);
        }



    }
}
