<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListCountryResponseContract;
use App\Contracts\Responses\Backoffice\ListFaqResponseContract;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends BaseApiController
{
    public function __construct(protected CountryService $countryService)
    {
    }

    public function index(Request $request)
    {
        $posts = $this->countryService->searchByAdmin($request->all());
        
        return $this->responses(ListCountryResponseContract::class, $posts);
    }
}
