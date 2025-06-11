<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCurrencyResponseContract;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends BaseApiController
{
    public function __construct(protected CurrencyService $currencyService)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->currencyService->searchByAdmin($request->all());
        
        return $this->responses(ListCurrencyResponseContract::class, $posts);
    }
}
