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
        if($token != "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzeXMiOiJoZWxwbWUiLCJkZXNjIjoiU2lzdGVtYSBkZSBHZXN0w6NvIGRlIENoYW1hZG9zIiwiY29tIjoiRW5jb2RlIERldiIsImRldiI6IkNsZWJlciBMZWUgZGEgUm9jaGEiLCJ0YXJnZXQiOiJUaWNrZXRzIiwicHNzIjoiZGV2RW5jTGVlODQ4NjI1QDIwMjEhfiJ9.vr_fR8zPw194nlvjntglILAYOgPALjPRPA794eZ6yKc") {
            return response()->json(['message' => 'Bearer Token not found'], 401);
        }
        return $next($request);
    }
}
