<?php

namespace App\Http\Controllers\Backoffice;

use App\Enum\DepositStatusEnum;
use App\Enum\OrderStatusEnum;
use Illuminate\Http\Request;
use App\Models\DepositTransaction;
use App\Models\PaymentOption;
use App\Models\User;
use App\Services\DepositService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaymentController extends BaseController
{
    protected $depositService;

    public function __construct(DepositService $depositService)
    {
        $this->depositService = $depositService;
    }

    public function createPayment(Request $request)
    {
        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.url');
        $vnp_ReturnUrl = config('services.vnpay.return_url');

        // Lấy order_id và amount từ query parameters
        $orderId = $request->query('order_id');
        $amount = $request->query('amount');

        if (!$orderId || !$amount || !is_numeric($amount)) {
            Log::error('Thông tin đơn hàng hoặc số tiền không hợp lệ', [
                'order_id' => $orderId,
                'amount' => $amount,
            ]);
            return redirect()->back()->with('error', 'Thông tin đơn hàng hoặc số tiền không hợp lệ.');
        }

        // Tìm đơn hàng
        $order = \App\Models\Order::find($orderId);
        if (!$order) {
            Log::error('Không tìm thấy đơn hàng', ['order_id' => $orderId]);
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Tìm người dùng
        $user = User::find($order->user_id);
        if (!$user) {
            Log::error('Không tìm thấy người dùng', ['user_id' => $order->user_id]);
            return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
        }

        // Tìm tùy chọn thanh toán
        $paymentOption = PaymentOption::find(2); // Giả sử ID 2 là VNPay
        if (!$paymentOption) {
            Log::error('Không tìm thấy tùy chọn thanh toán VNPay', ['payment_option_id' => 2]);
            return redirect()->back()->with('error', 'Tùy chọn thanh toán không hợp lệ.');
        }

        // Sử dụng DepositService để tạo giao dịch
        try {
            $deposit = $this->depositService->deposit($user, $amount, $paymentOption, [
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo giao dịch deposit', [
                'order_id' => $orderId,
                'amount' => $amount,
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Lỗi khi tạo giao dịch thanh toán.');
        }

        // Đảm bảo trạng thái đơn hàng là WAITING_FOR_PAYMENT
        $order->update([
            'order_status' => OrderStatusEnum::WAITING_FOR_PAYMENT,
            'payment_status' => 'waiting_for_payment',
        ]);

        // Tạo URL thanh toán VNPay
        $vnp_TxnRef = $deposit->transaction_code;
        $vnp_OrderInfo = "Thanh toán đơn hàng #{$orderId}";
        $vnp_OrderType = "topup";
        $vnp_Amount = $amount * 100;
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

        Log::info('Tạo URL thanh toán VNPay', [
            'order_id' => $orderId,
            'transaction_code' => $vnp_TxnRef,
            'url' => $vnp_Url,
        ]);

        return redirect()->away($vnp_Url);
    }

    public function paymentIpn(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $inputData = $request->all();

        // Kiểm tra chữ ký bảo mật
        if (!isset($inputData['vnp_SecureHash'])) {
            Log::error('VNPay IPN: Thiếu chữ ký bảo mật', ['input' => $inputData]);
            return response()->json(['RspCode' => '97', 'Message' => 'Missing Secure Hash']);
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $calculatedHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Lấy thông tin từ input
        $txnRef = $inputData['vnp_TxnRef'] ?? null;
        $orderId = $inputData['vnp_OrderInfo'] ? explode('#', $inputData['vnp_OrderInfo'])[1] : null;
        $amount = $inputData['vnp_Amount'] / 100; // Chuyển đổi về VND
        $cardType = $inputData['vnp_CardType'] ?? 'N/A';
        $payDate = $inputData['vnp_PayDate'] ?? null;

        // Định dạng ngày thanh toán
        $formattedPayDate = null;
        if ($payDate && preg_match('/^\d{14}$/', $payDate)) {
            try {
                $formattedPayDate = Carbon::createFromFormat('YmdHis', $payDate)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                Log::error('VNPay IPN: Lỗi định dạng ngày thanh toán', ['payDate' => $payDate, 'error' => $e->getMessage()]);
            }
        }

        // Kiểm tra chữ ký
        if ($vnp_SecureHash === $calculatedHash) {
            $status = $inputData['vnp_ResponseCode'] == '00' ? DepositStatusEnum::APPROVED : DepositStatusEnum::FAILED;

            // Tìm giao dịch theo transaction_code
            $deposit = DepositTransaction::where('transaction_code', $txnRef)->first();

            if (!$deposit) {
                \Log::error('VNPay IPN: Không tìm thấy giao dịch', ['transaction_code' => $txnRef]);
                return response()->json(['RspCode' => '01', 'Message' => 'Transaction not found']);
            }

            // Cập nhật trạng thái giao dịch
            try {
                $deposit->update([
                    'status' => $status,
                    'bank_account' => $inputData['vnp_BankCode'] ?? $deposit->bank_account,
                    'note' => 'Thanh toán VNPay ' . ($status == DepositStatusEnum::APPROVED ? 'thành công' : 'thất bại') .
                        '. Card Type: ' . $cardType .
                        '. Pay Date: ' . ($formattedPayDate ?? 'N/A'),
                ]);

                Log::info('VNPay IPN: Cập nhật trạng thái giao dịch', [
                    'deposit_id' => $deposit->id,
                    'status' => $status,
                    'order_id' => $orderId,
                ]);

                // Cập nhật trạng thái đơn hàng
                if ($orderId) {
                    $order = \App\Models\Order::find($orderId);
                    if ($order) {
                        $order->update([
                            'payment_status' => $status == DepositStatusEnum::APPROVED ? 'paid' : 'payment_failed',
                            'order_status' => $status == DepositStatusEnum::APPROVED ? OrderStatusEnum::PROCESSING : OrderStatusEnum::PAYMENT_ERROR,
                        ]);
                        Log::info('VNPay IPN: Cập nhật trạng thái đơn hàng', [
                            'order_id' => $orderId,
                            'payment_status' => $order->payment_status,
                            'order_status' => $order->order_status,
                        ]);
                    } else {
                        Log::error('VNPay IPN: Không tìm thấy đơn hàng', ['order_id' => $orderId]);
                    }
                }
            } catch (\Exception $e) {
                Log::error('VNPay IPN: Lỗi khi cập nhật giao dịch', [
                    'deposit_id' => $deposit->id,
                    'error' => $e->getMessage(),
                ]);
                return response()->json(['RspCode' => '99', 'Message' => 'Error updating transaction']);
            }

            return response()->json([
                'RspCode' => $status == DepositStatusEnum::APPROVED ? '00' : '01',
                'Message' => $status == DepositStatusEnum::APPROVED ? 'Confirm Success' : 'Confirm Failed'
            ]);
        }

        Log::error('VNPay IPN: Chữ ký không hợp lệ', ['txnRef' => $txnRef]);
        return response()->json(['RspCode' => '97', 'Message' => 'Invalid Signature']);
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

        $txnRef = $inputData['vnp_TxnRef'] ?? null;
        $orderId = $inputData['vnp_OrderInfo'] ? explode('#', $inputData['vnp_OrderInfo'])[1] : null;
        $cardType = $inputData['vnp_CardType'] ?? 'N/A';
        $payDate = $inputData['vnp_PayDate'] ?? null;

        // Tìm giao dịch
        $deposit = DepositTransaction::where('transaction_code', $txnRef)->first();

        if ($vnp_SecureHash === $calculatedHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                return view('backoffice.pages.payment.return', [
                    'status' => 'success',
                    'data' => array_merge($inputData, [
                        'vnp_CardType' => $cardType,
                        'vnp_PayDate' => $payDate,
                        'order_id' => $orderId,
                        'deposit_id' => $deposit ? $deposit->id : null,
                        'order_status' => $orderId ? \App\Models\Order::find($orderId)->order_status : null,
                        'order_status_label' => $orderId ? OrderStatusEnum::findConstantLabelVn(\App\Models\Order::find($orderId)->order_status) : null,
                    ]),
                    'message' => 'Giao dịch thành công, đang chờ xác nhận từ IPN',
                ]);
            }

            return view('backoffice.pages.payment.return', [
                'status' => 'error',
                'data' => array_merge($inputData, [
                    'vnp_CardType' => $cardType,
                    'vnp_PayDate' => $payDate,
                    'order_id' => $orderId,
                    'deposit_id' => $deposit ? $deposit->id : null,
                    'order_status' => $orderId ? \App\Models\Order::find($orderId)->order_status : null,
                    'order_status_label' => $orderId ? OrderStatusEnum::findConstantLabelVn(\App\Models\Order::find($orderId)->order_status) : null,
                ]),
                'message' => 'Giao dịch thất bại: ' . ($inputData['vnp_ResponseCode'] ?? 'Unknown'),
            ]);
        }

        return view('backoffice.pages.payment.return', [
            'status' => 'invalid',
            'data' => array_merge($inputData, [
                'vnp_CardType' => $cardType,
                'vnp_PayDate' => $payDate,
                'order_id' => $orderId,
                'deposit_id' => $deposit ? $deposit->id : null,
                'order_status' => $orderId ? \App\Models\Order::find($orderId)->order_status : null,
                'order_status_label' => $orderId ? OrderStatusEnum::findConstantLabelVn(\App\Models\Order::find($orderId)->order_status) : null,
            ]),
            'message' => 'Chữ ký không hợp lệ',
        ]);
    }
}