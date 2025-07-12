<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    public function __construct($content)
    {
        $this->content = $content; 
    }

    public function build()
    {
        return $this->subject('Tin tức mới từ UchiMart')->view('emails.newsletter');
    }
}
