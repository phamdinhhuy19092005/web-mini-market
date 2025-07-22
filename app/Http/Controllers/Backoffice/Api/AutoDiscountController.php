<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListAutoDiscountResponseContract;
use App\Services\AutoDiscountService;
use Illuminate\Http\Request;

class AutoDiscountController extends BaseApiController
{
    public function __construct(protected AutoDiscountService $autoDiscountService)
    {
    }

    public function index(Request $request)
    {
        $AuoDiscounts = $this->autoDiscountService->searchByAdmin($request->all());
        
        return $this->responses(ListAutoDiscountResponseContract::class, $AuoDiscounts);
    }
}
