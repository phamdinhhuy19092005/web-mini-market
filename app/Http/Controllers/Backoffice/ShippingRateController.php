<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreShippingRateResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingRateResponseContract;
use App\Enum\ShippingRateTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreShippingRateRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateShippingRateRequestInterface;
use App\Models\ShippingZone;
use App\Services\ShippingRateService;
use Illuminate\Http\Request;

class ShippingRateController extends BaseController
{
    protected $shippingRateService;

    public function __construct(ShippingRateService $shippingRateService)
    {
        $this->shippingRateService = $shippingRateService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.shipping-rates.index');
    }

    public function create()
    {
        $shippingZones = ShippingZone::all();
        $shippingRateTypeEnumLabels = ShippingRateTypeEnum::labels();
        return view('backoffice.pages.shipping-rates.create', compact('shippingZones', 'shippingRateTypeEnumLabels'));
    }

    public function store(StoreShippingRateRequestInterface $request)
    {
        $rate = $this->shippingRateService->create($request->validated());

        return $this->responses(StoreShippingRateResponseContract::class, $rate);
    }

    public function show($id)
    {
        $rate = $this->shippingRateService->show($id);
        $shippingZones = ShippingZone::all();
        $shippingRateTypeEnumLabels = ShippingRateTypeEnum::labels();

        return view('backoffice.pages.shipping-rates.edit', compact('rate', 'shippingZones', 'shippingRateTypeEnumLabels'));
    }

    public function edit($id)
    {
        $rate = $this->shippingRateService->show($id);
        $shippingZones = ShippingZone::all();
        $shippingRateTypeEnumLabels = ShippingRateTypeEnum::labels();

        return view('backoffice.pages.shipping-rates.edit', compact('rate', 'shippingZones', 'shippingRateTypeEnumLabels'));
    }

    public function update(UpdateShippingRateRequestInterface $request, $id)
    {
        $rate = $this->shippingRateService->update($id, $request->validated());

        return $this->responses(UpdateShippingRateResponseContract::class, $rate);
    }

    public function destroy($id)
    {
        $this->shippingRateService->delete($id);

        return redirect()->route('bo.web.shipping-rates.index');
    }

}
