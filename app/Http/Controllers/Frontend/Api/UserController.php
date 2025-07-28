<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'provider' => $user->provider,
            'access_channel_type' => $user->access_channel_type,
            'avatar' => $user->avatar,
            'genders' => $user->genders,
            'created_at' => $user->created_at,
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->genders = $request->input('genders');
            $user->birthday = $request->input('birthday');
            $user->phone_number = $request->input('phone_number');
            $user->save();

            return response()->json([
                'message' => 'Cập nhật thành công!',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật người dùng',
                'error' => $e->getMessage()
            ], 500);
        }
    }



}
