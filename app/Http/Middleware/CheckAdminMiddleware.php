<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class CheckAdminMiddleware
{

    public function handle($request, Closure $next)
    {
        $token = request()->bearerToken();
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        if($decoded->is_admin){
            return $next($request);
        }else{
            return response()->json(['status'=>'error','message'=>'access denied'],403);
        }

    }
}

