<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseApiController extends Controller
{
    protected $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user(); 
    }

    /**
     * Hàm tiện ích trả về response dạng chuẩn
     */
    protected function respondSuccess($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Hàm tiện ích trả về response lỗi
     */
    protected function respondError($message = 'Error', $code = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
