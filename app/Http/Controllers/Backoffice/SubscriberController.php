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

        $subscribers = Subscriber::where('sent_post', 0)->get();

        foreach ($subscribers as $subscriber) {
            Mail::raw($request->content, function ($message) use ($subscriber, $request) {
                $message->to($subscriber->email)->subject($request->subject);
            });

            $subscriber->update(['sent_post' => 1]);
        }

        return back()->with('success', 'Đã gửi mail đến tất cả subscriber chưa nhận.');
    }


}
