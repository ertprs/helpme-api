<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenBearer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if($token != "Bearer ".env("JWT_SECRET")) {
            return response()->json(['message' => 'Bearer Token not found'], 401);
        }
        return $next($request);
    }
}
