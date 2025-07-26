<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{
    public function responses($responseClass, $resource = null)
    {
        return app($responseClass, ['resource' => $resource]);
    }

    protected function jsonResponse($success, $data = null, $message = null, $status = 200): JsonResponse
    {
        $response = ['success' => $success];

        if ($data !== null) {
            $response['data'] = $data;
        }

        if ($message !== null) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
}
