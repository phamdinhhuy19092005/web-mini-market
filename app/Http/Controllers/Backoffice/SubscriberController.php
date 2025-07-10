<?php

namespace App\Http\Controllers\Backoffice;

use App\Services\SubscriberService;
use Illuminate\Http\Request;


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

}
