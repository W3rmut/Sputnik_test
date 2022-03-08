<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class OwnerAccountCheckMiddleware
{

    public function handle($request, Closure $next)
    {
        $userId =  $request->route()[2]['userId'];
        $token = request()->bearerToken();
        $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        if($decoded->id==$userId){
            return $next($request);
        }else{
            return response()->json(['status'=>'error','message'=>'Access denied'],403);
        }

    }
}
