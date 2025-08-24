<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends BaseController
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'amount' => 'required|numeric|min:1000',
        ]);

        $backendUrl = config('services.vnpay.backend_create_url');

        $response = Http::post($backendUrl, [
            'order_id' => $request->order_id,
            'amount' => $request->amount,
        ]);

        if ($response->successful()) {
            return response()->json([
                'url' => $response['url'] ?? null,
            ]);
        }

        return response()->json([
            'message' => 'Không thể tạo thanh toán',
        ], 500);
    }

    public function paymentReturn(Request $request)
    {
        return response()->json($request->all());
    }
}
