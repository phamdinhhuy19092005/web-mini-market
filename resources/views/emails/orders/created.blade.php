@component('mail::message')
<style>
    body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 20px; }
    .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h1 { font-size: 24px; margin-bottom: 20px; }
    .section { margin-bottom: 25px; }
    .details p { margin: 10px 0; font-size: 14px; color: #333; }
    .details strong { color: #1a1a1a; }
    table { width: 100%; border-collapse: collapse; margin: 15px 0; }
    table th, table td { padding: 12px; text-align: left; border: 1px solid #ddd; }
    table th { background-color: #f9f9f9; font-weight: bold; }
    table td[align="center"] { text-align: center; }
    table td[align="right"] { text-align: right; }
    .total { margin-top: 15px; font-size: 16px; }
    .total span { color: #00c73c; font-weight: bold; }
    .button { display: inline-block; padding: 12px 25px; background-color: #00c73c; color: #fff !important; text-decoration: none; border-radius: 5px; font-weight: bold; transition: transform 0.3s ease; }
    .button:hover { transform: scale(1.05); }
    .footer { margin-top: 20px; font-size: 12px; color: #666; text-align: center; }
</style>


# <h1>Cảm ơn bạn đã sử dụng dịch vụ!</h1>
**Tổng cộng:** <span style="color:#00c73c;font-size:18px;font-weight:bold;">{{ number_format($order->total_price) }}₫</span>  

**Người dùng ghi chú:** {{ $order->user_note ?? '---' }}

**Thời gian giao hàng:** {{ $order->delivery_date }}

---

# Chi tiết đơn hàng

<div class="section details">
    <p><strong>Đặt bởi:</strong> {{ $order->user->name ?? 'Khách hàng' }}</p>
    <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
    <p><strong>Đặt từ:</strong> UCHIMART - HỒ CHÍ MINH</p>
    <p><strong>Giao đến:</strong> {{ $order->address_line . ' ,' . $order->city_name }}</p>
</div>

---

# Tóm tắt đơn hàng  
**Phương thức thanh toán:** {{ $order->paymentOption->name ?? 'Chưa chọn' }}

<table width="100%" cellpadding="6" cellspacing="0" border="1" style="border-collapse:collapse;">
    <thead>
        <tr>
            <th align="left">Sản phẩm</th>
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

<div class="section total">
    <p><strong>Phí dịch vụ:</strong> {{ number_format($order->service_fee ?? 0) }}₫</p>
    <p><strong>Tổng giá:</strong> <span style="color:#00c73c;font-size:16px;font-weight:bold;">{{ number_format($order->total_price) }}₫</span></p>
</div>

---

<a href="{{ url('https://www.uchimart.site/') }}"
   style="display:inline-block; background:#00b14f; color:#fff; 
          padding:12px 24px; border-radius:6px; text-decoration:none; 
          font-weight:bold; font-size:14px;">
   ĐẾN NGAY UCHIMART
</a>

<div class="footer">
    Cảm ơn bạn đã mua sắm tại **UCHIMART**
</div>
@endcomponent