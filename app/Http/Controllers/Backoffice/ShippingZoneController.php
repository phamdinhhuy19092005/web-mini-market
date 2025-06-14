<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreShippingZoneResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingZoneResponseContract;
use App\Http\Requests\Interfaces\StoreShippingZoneRequestInterface;
use App\Http\Requests\Interfaces\UpdateShippingZoneRequestInterface;
use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use App\Services\shippingZoneService;
use Illuminate\Http\Request;

class ShippingZoneController extends BaseController
{
    protected $shippingZoneService;

    public function __construct(shippingZoneService $shippingZoneService)
    {
        $this->shippingZoneService = $shippingZoneService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.shipping-zones.index');
    }

    public function create()
    {
        $countries = Country::select('iso2', 'name')->distinct()->get();
        $provinces = Province::select('code', 'full_name')->distinct()->get();
        $districts = $this->shippingZoneService->getFormattedDistricts();

        return view('backoffice.pages.shipping-zones.create', compact('countries', 'provinces', 'districts'));
    }


    public function store(StoreShippingZoneRequestInterface $request)
    {
        $shippingZone = $this->shippingZoneService->create($request->validated());

        return $this->responses(StoreShippingZoneResponseContract::class, $shippingZone);
    }

    public function show($id)
    {
        $shippingZone = $this->shippingZoneService->show($id);

        $countries = Country::select('iso2', 'name')->distinct()->get();
        $provinces = Province::select('code', 'full_name')->distinct()->get();
        $districts = $this->shippingZoneService->getFormattedDistricts();

        return view('backoffice.pages.shipping-zones.edit', compact('shippingZone', 'countries', 'provinces', 'districts'));
    }

    public function edit($id)
    {
        $shippingZone = $this->shippingZoneService->show($id);

        $countries = Country::select('iso2', 'name')->distinct()->get();
        $provinces = Province::select('code', 'full_name')->distinct()->get();
        $districts = $this->shippingZoneService->getFormattedDistricts();

        return view('backoffice.pages.shipping-zones.edit', compact('shippingZone', 'countries', 'provinces', 'districts'));
    }


    public function update(UpdateShippingZoneRequestInterface $request, $id)
    {
        $shippingZone = $this->shippingZoneService->update($id, $request->validated());

        return $this->responses(UpdateShippingZoneResponseContract::class, $shippingZone);
    }

    public function destroy($id)
    {
        $this->shippingZoneService->delete($id);

        return redirect()->route('bo.web.shipping-zones.index');
    }

}
