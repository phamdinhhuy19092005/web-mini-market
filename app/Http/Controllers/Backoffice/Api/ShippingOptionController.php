<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListShippingRateResponseContract;
use App\Models\ShippingOption;
use App\Services\ShippingOptionService;
use Illuminate\Http\Request;

class ShippingOptionController extends BaseApiController
{
    public function __construct(protected ShippingOptionService $shippingOptionService)
    {
    }

    public function index(Request $request)
    {
        $shippingOptions = $this->shippingOptionService->searchByAdmin($request->all());
        
        return $this->responses(ListShippingRateResponseContract::class, $shippingOptions);
    }

    public function getAvailableShippingOptions(Request $request)
    {
        $provinceCode = $request->query('province_code');
        $status = $request->query('status', 1);

        $shippingOptions = ShippingOption::where('status', $status)
            ->whereJsonContains('supported_provinces', $provinceCode)
            ->get(['id', 'name'])
            ->toArray();

        return response()->json($shippingOptions);
    }

}
