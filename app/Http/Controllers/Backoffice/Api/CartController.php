<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCartResponseContract;
use App\Contracts\Responses\Backoffice\ListCouponResponseContract;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends BaseApiController
{
    public function __construct(protected CartService $CartService)
    {
    }

    public function index(Request $request)
    {
        $carts = $this->CartService->searchByAdmin($request->all());
        
        return $this->responses(ListCartResponseContract::class, $carts);
    }
}
