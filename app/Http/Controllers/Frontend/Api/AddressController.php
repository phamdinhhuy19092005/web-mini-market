<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Contracts\Responses\Backoffice\StoreAddressResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAddressResponseContract;
use App\Http\Requests\Backoffice\Interfaces\StoreAddressRequestInterface;
use App\Http\Controllers\Frontend\BaseController;
use App\Http\Requests\Backoffice\Interfaces\UpdateAddressRequestInterface;
use App\Http\Resources\Frontend\AddressResource;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\JsonResponse;


class AddressController extends BaseController
{
    protected $addressService;
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    public function index(): JsonResponse
    {
        $addresses = Address::all();
        return $this->jsonResponse(true, AddressResource::collection($addresses));
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
        $address = $this->addressService->create($request->validated());

        return $this->responses(StoreAddressResponseContract::class, $address);
    }

    public function update(UpdateAddressRequestInterface $request, $id): JsonResponse
    {
        $address = $this->addressService->update($id, $request->validated());

        return $this->responses(UpdateAddressResponseContract::class, $address);
    }
}
