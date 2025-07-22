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
        return response()->json($user);
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
