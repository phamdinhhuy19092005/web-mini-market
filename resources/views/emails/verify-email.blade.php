@component('mail::message')
# Xin chào {{ $user->name }}

Vui lòng nhấn vào nút bên dưới để xác minh email của bạn:

@component('mail::button', ['url' => $verifyUrl])
Xác minh Email
@endcomponent

Nếu bạn không tạo tài khoản này, vui lòng bỏ qua email này.

Cảm ơn bạn đã đăng ký!
{{ config('app.name') }}
@endcomponent
