<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListSubscriberResponseContract;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscriberController extends BaseApiController
{
    public function __construct(protected SubscriberService $subscriberService)
    {
    }

    public function index(Request $request)
    {
        $subscribers = $this->subscriberService->searchByAdmin($request->all());
        
        return $this->responses(ListSubscriberResponseContract::class, $subscribers);
    }
}
