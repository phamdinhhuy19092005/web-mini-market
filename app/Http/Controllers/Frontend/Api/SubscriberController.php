<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Enum\SubscriberTypeEnum;
use App\Http\Controllers\Frontend\BaseController;
use App\Http\Resources\Frontend\WardResource;
use App\Models\Ward;
use App\Services\SubscriberService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriberController extends BaseController
{
    protected SubscriberService $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }


    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = $this->subscriberService->create([
            'email' => $request->input('email'),
            'type'  => SubscriberTypeEnum::NEWSLETTER,
        ]);

        $data = $subscriber->toArray();
        $data['type_name'] = SubscriberTypeEnum::getName($subscriber->type);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công!',
            'data' => $data,
        ]);
    }


}
