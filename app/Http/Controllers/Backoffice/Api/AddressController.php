<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListAddressResponseContract;
use App\Models\Address;
use App\Models\District;
use App\Models\Ward;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class AddressController extends BaseApiController
{
    public function __construct(protected AddressService $addressService)
    {
    }

    public function index(Request $request)
    {
        $addresses = $this->addressService->searchByAdmin($request->all());

        return $this->responses(ListAddressResponseContract::class, $addresses);
    }

    public function getDistricts($province_code)
    {
        $districts = District::where('province_code', $province_code)->get();
        return response()->json($districts);
    }

    public function getWards($district_code)
    {
        $wards = Ward::where('district_code', $district_code)->get();
        return response()->json($wards);
    }

    public function destroy($id): JsonResponse
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Địa chỉ không tồn tại'
            ], 404);
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoá địa chỉ thành công'
        ]);
    }


}