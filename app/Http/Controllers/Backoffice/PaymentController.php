<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Models\DepositTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaymentController extends BaseController
{
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.url');
        $vnp_ReturnUrl = config('services.vnpay.return_url');

        $vnp_TxnRef = time();
        $vnp_OrderInfo = "Thanh toán đơn hàng test";
        $vnp_OrderType = "topup";
        $vnp_Amount = 1000000 * 100; // 1,000,000 VND
        $vnp_Locale = "vn";
        $vnp_IpAddr = $request->ip();
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        ];

        ksort($inputData);
        $query = http_build_query($inputData);
        $vnp_SecureHash = hash_hmac('sha512', $query, $vnp_HashSecret);
        $vnp_Url .= '?' . $query . '&vnp_SecureHash=' . $vnp_SecureHash;

        return redirect()->away($vnp_Url);
    }

    public function paymentReturn(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $inputData = $request->all();

        if (!isset($inputData['vnp_SecureHash'])) {
            return view('backoffice.pages.payment.return', [
                'status' => 'error',
                'data' => $inputData,
                'message' => 'Thiếu chữ ký bảo mật (vnp_SecureHash)',
            ]);
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $calculatedHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $cardType = $inputData['vnp_CardType'] ?? 'N/A';
        $payDate = $inputData['vnp_PayDate'] ?? null;

        if ($vnp_SecureHash === $calculatedHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                return view('backoffice.pages.payment.return', [
                    'status' => 'success',
                    'data' => array_merge($inputData, [
                        'vnp_CardType' => $cardType,
                        'vnp_PayDate' => $payDate,
                    ]),
                    'message' => 'Giao dịch thành công, đang chờ xác nhận từ IPN',
                ]);
            }

            return view('backoffice.pages.payment.return', [
                'status' => 'error',
                'data' => array_merge($inputData, [
                    'vnp_CardType' => $cardType,
                    'vnp_PayDate' => $payDate,
                ]),
                'message' => 'Giao dịch thất bại: ' . ($inputData['vnp_ResponseCode'] ?? 'Unknown'),
            ]);
        }

        return view('backoffice.pages.payment.return', [
            'status' => 'invalid',
            'data' => array_merge($inputData, [
                'vnp_CardType' => $cardType,
                'vnp_PayDate' => $payDate,
            ]),
            'message' => 'Chữ ký không hợp lệ',
        ]);
    }

    public function paymentIpn(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $inputData = $request->all();

        if (!isset($inputData['vnp_SecureHash'])) {
            return response()->json(['RspCode' => '97', 'Message' => 'Missing Secure Hash']);
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $calculatedHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $cardType = $inputData['vnp_CardType'] ?? 'N/A';
        $payDate = $inputData['vnp_PayDate'] ?? null;
        $formattedPayDate = null;

        if ($payDate && preg_match('/^\d{14}$/', $payDate)) {
            try {
                $formattedPayDate = Carbon::createFromFormat('YmdHis', $payDate)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                //
            }
        }

        if ($vnp_SecureHash === $calculatedHash) {
            $status = $inputData['vnp_ResponseCode'] == '00' ? 1 : 0;
            $existingTransaction = DepositTransaction::where('transaction_code', $inputData['vnp_TxnRef'])->first();

            if (!$existingTransaction) {
                DepositTransaction::create([
                    'user_id' => Auth::id() ?? 1,
                    'payment_option_id' => 2,
                    'amount' => $inputData['vnp_Amount'] / 100,
                    'bank_account' => $inputData['vnp_BankCode'] ?? null,
                    'transfer_content' => $inputData['vnp_OrderInfo'] ?? null,
                    'transaction_code' => $inputData['vnp_TxnRef'] ?? null,
                    'status' => $status,
                    'note' => 'Thanh toán VNPay ' . ($status ? 'thành công' : 'thất bại') .
                        '. Card Type: ' . $cardType .
                        '. Pay Date: ' . ($formattedPayDate ?? 'N/A'),
                ]);
            }

            return response()->json([
                'RspCode' => $status ? '00' : '01',
                'Message' => $status ? 'Confirm Success' : 'Confirm Failed'
            ]);
        }

        return response()->json(['RspCode' => '97', 'Message' => 'Invalid Signature']);
    }
}
    