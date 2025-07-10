<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListBrandResponseContract;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends BaseApiController
{
    public function __construct(protected BrandService $brandService)
    {
    }

    public function index(Request $request)
    {
        $brand = $this->brandService->searchByAdmin($request->all());
        
        return $this->responses(ListBrandResponseContract::class, $brand);
    }
}
