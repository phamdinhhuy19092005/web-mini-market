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
    protected function respondSuccess($success = true, $data = null, $message = 'Success', $code = 200)
{
    $code = (int) $code;
    if ($code < 100 || $code > 599) {
        $code = 200; // fallback
    }

    return response()->json([
        'success' => $success,
        'message' => $message,
        'data'    => $data,
    ], $code);
}

protected function respondError($success = false, $data = null, $message = 'Error', $code = 400, $errors = null)
{
    $code = (int) $code;
    if ($code < 100 || $code > 599) {
        $code = 400; // fallback
    }

    return response()->json([
        'success' => $success,
        'message' => $message,
        'data'    => $data,
        'errors'  => $errors,
    ], $code);
}

}
