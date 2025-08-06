<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreShippingOptionResponseContract;
use App\Contracts\Responses\Backoffice\UpdateShippingOptionResponseContract;
use App\Enum\ShippingOptionTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreShippingOptionRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateShippingOptionRequestInterface;
use App\Models\Country;
use App\Models\Province;
use App\Models\ShippingProvider;
use App\Services\ShippingOptionService;


class ShippingOptionController extends BaseController
{
    protected $shippingOptionService;

    public function __construct(ShippingOptionService $shippingOptionService)
    {
        $this->shippingOptionService = $shippingOptionService;
    }

    public function index()
    {
        return view('backoffice.pages.shipping-options.index');
    }

    public function create()
    {
        $shippingProviders = ShippingProvider::all();
        $ShippingOptionTypeEnumLables = ShippingOptionTypeEnum::labels();
        $countries = Country::select('iso2', 'name')->distinct()->get();
        $provinces = Province::select('code', 'full_name')->distinct()->get();
        return view('backoffice.pages.shipping-options.create', compact('shippingProviders', 'ShippingOptionTypeEnumLables', 'countries', 'provinces'));
    }


    public function store(StoreShippingOptionRequestInterface $request)
    {
        $shippingOption = $this->shippingOptionService->create($request->validated());

        return $this->responses(StoreShippingOptionResponseContract::class, $shippingOption);
    }

    public function show($id)
    {
       $shippingOption = $this->shippingOptionService->show($id);

        return view('backoffice.pages.shipping-options.edit', compact('shippingOption'));
    }

    public function update(UpdateShippingOptionRequestInterface $request, $id)
    {
        $shippingOption = $this->shippingOptionService->update($id, $request->validated());

        return $this->responses(UpdateShippingOptionResponseContract::class, $shippingOption);
    }

    public function destroy($id)
    {
        $this->shippingOptionService->delete($id);

        return redirect()->route('bo.web.shipping-options.index');
    }

}
