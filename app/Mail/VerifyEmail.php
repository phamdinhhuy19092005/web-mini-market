<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verifyUrl;

    public function __construct($user, $verifyUrl)
    {
        $this->user = $user;
        $this->verifyUrl = $verifyUrl;
    }

    public function build()
    {
        return $this->subject('Xác minh Email của bạn')
                    ->markdown('emails.verify-email')
                    ->with([
                        'user' => $this->user,
                        'verifyUrl' => $this->verifyUrl,
                    ]);
    }
}
