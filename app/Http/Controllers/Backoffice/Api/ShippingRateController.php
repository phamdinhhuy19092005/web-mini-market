<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListShippingRateResponseContract;
use App\Services\ShippingRateService;
use Illuminate\Http\Request;

class ShippingRateController extends BaseApiController
{
    public function __construct(protected ShippingRateService $shippingRateService)
    {
    }

    public function index(Request $request)
    {
        $shippingRate = $this->shippingRateService->searchByAdmin($request->all());
        
        return $this->responses(ListShippingRateResponseContract::class, $shippingRate);
    }
}
