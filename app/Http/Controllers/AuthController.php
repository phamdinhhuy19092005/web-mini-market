<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Firebase\JWT\JWT;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
class AuthController extends BaseController
{
   public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Sai email hoặc mật khẩu'], 401);
        }

        // Tạo payload
        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + 3600,
        ];

        // Encode token
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return response()->json([
    'user' => [
        'id' => $user->id,
        'email' => $user->email,
        'name' => $user->name,
        'avatar' => $user->avatar ?? null,
        'phone_number' => $user->phone_number ?? null,
        'birthday' => $user->birthday ?? null,
        'genders' => $user->genders ?? null,
        'token' => $token
    ]
]);

    }

      public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'phone_number'      => $request->phone_number,
                'currency_code'     => 'VND',
                'genders'           => $request->genders,
                'birthday'          => $request->birthday,
                'status'            => 1,
                'allow_login'       => 1,
                'access_channel_type' => 2,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Register success',
                'data'    => $user,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Register failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
