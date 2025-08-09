@component('mail::message')
# Xin chào {{ $user->name }}

Vui lòng nhấn vào nút bên dưới để xác minh email của bạn:

@component('mail::button', ['url' => url('/verify-email?token=' . $token)])
Xác minh Email
@endcomponent

Cảm ơn bạn đã đăng ký!
@endcomponent
