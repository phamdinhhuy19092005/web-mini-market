@extends('backoffice.layouts.master')

@section('content_body')
<div class="k-content__body k-grid__item k-grid__item--fluid d-flex justify-content-center align-items-center py-5" id="k_content_body">
    <div class="card shadow-lg border-0 rounded-xl" style="max-width: 400px; width: 100%;">
        <div class="card-body text-center p-5 bg-white">
            @if($status === 'success')
                <div class="mb-4">
                    <div class="bg-light rounded-circle d-flex justify-content-center align-items-center mx-auto" style="width: 80px; height: 80px;">
                        <i class="fas fa-check text-success fa-2x"></i>
                    </div>
                    <h3 class="mt-4 font-weight-bold text-dark">Thanh toán thành công</h3>
                    <p class="text-muted mb-4">Bạn đã thanh toán thành công đơn hàng.</p>
                </div>

                <div class="bg-light rounded p-3 text-left mb-4">
                    <h4 class="text-primary font-weight-bold">{{ number_format($data['vnp_Amount'] / 100) }} VND</h4>
                    <hr>
                    <p class="mb-1"><strong>Mã giao dịch:</strong> {{ $data['vnp_TxnRef'] }}</p>
                    <p class="mb-1"><strong>Từ:</strong> Thẻ ATM - {{ $data['vnp_CardType'] }}</p>
                    <p class="mb-1"><strong>Thời gian:</strong> {{ \Carbon\Carbon::parse($data['vnp_PayDate'])->format('d/m/Y H:i') }}</p>
                </div>

                <a href="/" class="btn btn-primary btn-block font-weight-bold py-2">Về trang chủ</a>
            @elseif($status === 'error')
                <div class="text-center">
                    <i class="fas fa-times-circle text-danger fa-3x mb-3"></i>
                    <h4 class="text-danger font-weight-bold">Thanh toán thất bại</h4>
                    <p><strong>Mã lỗi:</strong> {{ $data['vnp_ResponseCode'] }}</p>
                    <a href="/" class="btn btn-outline-danger mt-4">Thử lại</a>
                </div>
            @else
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <h4 class="text-warning font-weight-bold">Lỗi chữ ký</h4>
                    <p>Chữ ký không hợp lệ. Vui lòng thử lại hoặc liên hệ hỗ trợ.</p>
                    <a href="/" class="btn btn-outline-warning mt-4">Về trang chủ</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
