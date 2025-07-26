<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function createPayment(Request $request): JsonResponse
    {
        try {
            $payment = Payment::create($request->all());
            return $this->jsonResponse(true, new PaymentResource($payment), 'Tạo thanh toán thành công');
        } catch (\Exception $e) {
            return $this->jsonResponse(false, null, 'Lỗi khi tạo thanh toán: ' . $e->getMessage(), 500);
        }
    }

    public function paymentReturn(Request $request): JsonResponse
    {
        try {
            $payment = Payment::where('transaction_id', $request->input('transaction_id'))->first();
            if (!$payment) {
                return $this->jsonResponse(false, null, 'Giao dịch không tìm thấy', 404);
            }
            return $this->jsonResponse(true, new PaymentResource($payment), 'Xử lý phản hồi thanh toán thành công');
        } catch (\Exception $e) {
            return $this->jsonResponse(false, null, 'Lỗi khi xử lý phản hồi thanh toán: ' . $e->getMessage(), 500);
        }
    }
}