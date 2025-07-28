<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'user' => $user->only([
                'id',
                'name',
                'email',
                'genders',
                'birthday',
                'phone_number',
                'avatar',
                'access_channel_type',
                'provider',
                'created_at',
            ])
        ]);
    }

    public function update(Request $request, $id)
    {
        $start = microtime(true);

        try {
            $user = User::findOrFail($id);

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->genders = $request->input('genders');
            $user->birthday = $request->input('birthday');
            $user->phone_number = $request->input('phone_number');
            $user->save();

            $duration = round((microtime(true) - $start) * 1000, 2);

            return response()->json([
                'message' => 'Cập nhật thành công!',
                'user' => $user->only([
                    'id',
                    'name',
                    'email',
                    'genders',
                    'birthday',
                    'phone_number',
                    'avatar',
                    'access_channel_type',
                    'provider',
                    'created_at',
                ])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật người dùng',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
