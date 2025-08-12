<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Requests\Backoffice\Interfaces\StoreAddressRequestInterface;
use App\Http\Resources\Frontend\AddressResource;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Ward;

class AddressController extends BaseApiController
{
    protected $addressService;
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    public function index(): JsonResponse
{
    $user = auth()->user(); 

    if (!$user) {
        return $this->jsonResponse(false, null, 'Bạn chưa đăng nhập', 401);
    }

    $addresses = Address::where('user_id', $user->id)->get();

    return $this->jsonResponse(true, AddressResource::collection($addresses));
}


public function getWardsByDistrict($districtCode)
{
    $wards = Ward::where('district_code', str_pad($districtCode, 3, '0', STR_PAD_LEFT))
    ->select('code', 'full_name', 'district_code') // bỏ 'id'
    ->get();


    if ($wards->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy phường/xã cho district_code: ' . $districtCode
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $wards
    ]);
}



    public function getDistrictsByProvince($provinceCode)
{
    $districts = District::where('province_code', $provinceCode)
        ->select('id', 'code', 'full_name', 'province_code')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $districts
    ]);
}

    public function show($id): JsonResponse
    {
        $address = Address::find($id);
        if (!$address) {
            return $this->jsonResponse(false, null, 'Địa chỉ không tìm thấy', 404);
        }
        return $this->jsonResponse(true, new AddressResource($address));
    }

    public function store(StoreAddressRequestInterface $request): JsonResponse
{
    $data = $request->validated();
    $user = auth()->user();

    // Nếu chọn làm mặc định => bỏ mặc định của các địa chỉ khác
    if (!empty($data['is_default']) && $data['is_default']) {
        Address::where('user_id', $user->id)
            ->update(['is_default' => 0]);
    }

    // Gán user_id từ token
    $data['user_id'] = $user->id;

    $address = $this->addressService->create($data);

    return $this->jsonResponse(true, new AddressResource($address), 'Tạo địa chỉ thành công');
}


    public function update(Request $request, $id)
{
    $user = auth()->user();
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Bạn chưa đăng nhập hoặc token không hợp lệ.'
        ], 401);
    }

    $data = $request->all();

    // Nếu set mặc định => bỏ mặc định các địa chỉ khác
    if (!empty($data['is_default']) && $data['is_default']) {
        Address::where('user_id', $user->id)
            ->where('id', '!=', $id)
            ->update(['is_default' => 0]);
    }

    $address = Address::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$address) {
        return response()->json([
            'success' => false,
            'message' => 'Địa chỉ không tồn tại.'
        ], 404);
    }

    $address->update($data);

    return response()->json([
        'success' => true,
        'data' => $address,
        'message' => 'Cập nhật địa chỉ thành công.'
    ]);
}



public function setDefault($id): JsonResponse
{
    $user = auth()->user();
    if (!$user) {
        return $this->jsonResponse(false, null, 'Bạn chưa đăng nhập', 401);
    }

    $address = Address::where('id', $id)->where('user_id', $user->id)->first();
    if (!$address) {
        return $this->jsonResponse(false, null, 'Địa chỉ không tồn tại', 404);
    }

    // Bỏ mặc định các địa chỉ khác
    Address::where('user_id', $user->id)->update(['is_default' => 0]);

    // Set mặc định cho địa chỉ này
    $address->is_default = 1;
    $address->save();

    return $this->jsonResponse(true, new AddressResource($address), 'Cập nhật mặc định thành công');
}

}
