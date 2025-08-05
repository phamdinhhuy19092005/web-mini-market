<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\JwtHelper;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Token không hợp lệ'], 401);
        }

        $token = substr($authHeader, 7);
        $userData = JwtHelper::verifyToken($token);

        if (!$userData) {
            return response()->json(['error' => 'Token sai hoặc đã hết hạn'], 401);
        }

        // Gắn thông tin user từ token vào request
        $request->attributes->add(['jwt_user' => $userData]);

        return $next($request);
    }
}
