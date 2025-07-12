<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;

class EmailController extends BaseController
{
    public function showForm()
    {
        return view('backoffice.emails.send');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $subscribers = Subscriber::pluck('email')->toArray();

        foreach ($subscribers as $email) {
            Mail::raw($request->body, function ($message) use ($email, $request) {
                $message->to($email)->subject($request->subject);
            });
        }

        return back()->with('success', 'Đã gửi email đến tất cả subscriber!');
    }
}
