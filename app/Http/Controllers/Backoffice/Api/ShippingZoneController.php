<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListShippingZoneResponseContract;
use App\Services\ShippingZoneService;
use Illuminate\Http\Request;

class ShippingZoneController extends BaseApiController
{
    public function __construct(protected ShippingZoneService $shippingZoneService)
    {
    }

    public function index(Request $request)
    {
        $shippingZone = $this->shippingZoneService->searchByAdmin($request->all());
        
        return $this->responses(ListShippingZoneResponseContract::class, $shippingZone);
    }
}
