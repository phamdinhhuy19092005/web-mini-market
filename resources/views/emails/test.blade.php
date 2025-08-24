@component('mail::message')
<style>
    body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 20px; }
    .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    h1 { font-size: 20px; margin-bottom: 20px; color:#333; }
    h2 { font-size:16px; margin:20px 0 10px; color:#111; border-bottom:1px solid #eee; padding-bottom:5px;}
    .details p { margin: 6px 0; font-size: 14px; color: #333; }
    table { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 14px; }
    table th, table td { padding: 8px; border: 1px solid #eaeaea; }
    table th { background-color: #f9f9f9; font-weight: bold; text-align:left; }
    table td[align="center"] { text-align: center; }
    table td[align="right"] { text-align: right; }
    .summary { margin-top: 15px; font-size: 14px; }
    .summary p { margin: 6px 0; }
    .summary .total { font-size: 16px; font-weight: bold; color:#00c73c; margin-top:10px; }
    .button { display: inline-block; padding: 12px 24px; background: #00c73c; color: #fff !important; text-decoration: none; border-radius: 4px; font-weight: bold; }
    .button:hover { background: #009d2d; }
    .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; line-height:1.5; }
</style>

<div class="container">
    <h1>Cảm ơn bạn đã sử dụng dịch vụ UCHIMART</h1>

    <p><strong>Tổng cộng:</strong> 
        <span style="color:#00c73c;font-size:16px;font-weight:bold;">
            {{ number_format($order->total_price) }}₫
        </span>
    </p>

    <p><strong>Người dùng ghi chú:</strong> {{ $order->user_note ?? '---' }}</p>

    <h2>Chi tiết đơn hàng</h2>
    <div class="details">
        <p><strong>Đặt bởi:</strong> {{ $order->user->name ?? 'Khách hàng' }}</p>
        <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
        <p><strong>Đặt từ:</strong> UCHIMART</p>
        <p><strong>Giao đến:</strong> {{ $order->address_line . ' ,' . $order->city_name }}</p>
    </div>

    <h2>Tóm tắt đơn hàng</h2>
    <p><strong>Phương thức thanh toán:</strong> {{ $order->paymentOption->name ?? 'Chưa chọn' }}</p>

    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th align="center">SL</th>
                <th align="right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->inventory->title ?? 'Sản phẩm' }}</td>
                <td align="center">{{ $item->quantity }}</td>
                <td align="right">{{ number_format($item->total_price) }}₫</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Cước phí giao hàng:</strong> 16.000₫</p>
        <p><strong>Phí dịch vụ:</strong> {{ number_format($order->service_fee ?? 0) }}₫</p>
        <p class="total">Tổng giá: {{ number_format($order->total_price) }}₫</p>
    </div>

    <div style="text-align:center; margin:20px 0;">
        <a href="https://www.uchimart.site/" class="button">Mua sắm tại UCHIMART</a>
    </div>

    <div class="footer">
        Cảm ơn bạn đã mua sắm tại UCHIMART.<br>
        Nếu có thắc mắc, vui lòng liên hệ Trung tâm hỗ trợ.
    </div>
</div>
@endcomponent
