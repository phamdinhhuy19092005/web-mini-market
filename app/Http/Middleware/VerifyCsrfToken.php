<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'backoffice/payment/ipn',
    ];

    public function handle($request, \Closure $next)
    {
        dd([
            'request_data' => $request->all(), // Dữ liệu POST, bao gồm _token
            'session_csrf_token' => $request->session()->token(), // Token CSRF từ session
            'header_token' => $request->header('X-CSRF-TOKEN'), // Token từ header (nếu có)
        ]);
        return parent::handle($request, $next);
    }
}
