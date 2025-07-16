<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Subscriber;
use App\Services\SubscriberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends BaseController
{
    protected $SubscriberService;

    public function __construct(SubscriberService $SubscriberService)
    {
        $this->SubscriberService = $SubscriberService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.subscribers.index');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'content' => 'required|string',
        ]);

        $subscribers = Subscriber::pluck('email')->toArray();

        foreach ($subscribers as $email) {
            Mail::raw($request->content, function ($message) use ($email, $request) {
                $message->to($email)->subject($request->subject);
            });
        }

        return back();
    }

}
