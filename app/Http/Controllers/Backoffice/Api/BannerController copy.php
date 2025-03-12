<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListBannerResponseContract;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends BaseApiController
{
    public function __construct(protected BannerService $bannerService)
    {
        
    }

    public function index(Request $request)
    {
        $banners = $this->bannerService->searchByAdmin($request->all());

        return $this->responses(ListBannerResponseContract::class, $banners);
    }
}
