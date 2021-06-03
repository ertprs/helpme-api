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
        if($token != "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzeXMiOiJDeWJlcmRlbnVuY2llIiwiZGVzYyI6IlNpc3RlbWEgZGUgR2VzdMOjbyBkZSBEZW7Dum5jaWFzIiwiY29tIjoiRW5jb2RlIERldiIsImRldiI6IkNsZWJlciBMZWUgZGEgUm9jaGEiLCJ0YXJnZXQiOiJEZW7Dum5jaWFzIiwicHNzIjoiZGV2RW5jTGVlODQ4NjI1QDIwMjEhfiJ9.ZrOrkb_xlPgDO6JROJV_pm21ikDjDF_JVFv04u8rTyQ") {
            return response()->json(['message' => 'Bearer Token not found'], 401);
        }
        return $next($request);
    }
}
