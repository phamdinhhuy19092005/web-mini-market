<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAddressResponseContract; 
use App\Contracts\Responses\Backoffice\UpdateAddressResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreAddressRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAddressRequestInterface;
use App\Models\District;
use App\Models\PostCategory;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.addresses.index');
    }

    public function create()
    {
        $provinces = Province::select('code', 'full_name')->distinct()->get();
        $districts = $this->addressService->getFormattedDistricts();
        $wards = $this->addressService->getFormattedWards();
        $users = User::all();

        return view('backoffice.pages.addresses.create', compact('provinces','districts','wards' ,'users'));
    }

    public function store(StoreAddressRequestInterface $request)
    {
        $address = $this->addressService->create($request->validated());

        return $this->responses(StoreAddressResponseContract::class, $address);
    }

    public function show($id)
    {
        $provinces = Province::select('code', 'name', 'full_name')->get();
        $districts = District::select('code', 'name', 'province_code')->get();
        $wards = Ward::select('code', 'name', 'district_code')->get();
        $users = User::all();
        $address = $this->addressService->show($id);

        return view('backoffice.pages.addresses.edit', compact('provinces','districts','wards' ,'users', 'address'));
    }

    public function update(UpdateAddressRequestInterface $request, $id)
    {
        $address = $this->addressService->update($id, $request->validated());

        return $this->responses(UpdateAddressResponseContract::class, $address);
    }

    public function destroy($id)
    {
        $this->addressService->delete($id);
        
        return redirect()->route('bo.web.addresses.index');
    }
    
}
