<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtHelper
{
    public static function generateToken($payload = [])
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; 

        $payload = array_merge($payload, [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
        ]);

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public static function verifyToken($token)
    {
        try {
            return JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (Exception $e) {
            return null;
        }
    }
}
