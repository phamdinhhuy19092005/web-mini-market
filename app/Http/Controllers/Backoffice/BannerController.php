<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Http\Requests\Interfaces\StoreBannerRequestInterface;
use App\Http\Requests\Interfaces\UpdateBannerRequestInterface;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.banners.index');
    }

    public function create()
    {
        return view('backoffice.pages.banners.create');
    }

    public function store(StoreBannerRequestInterface $request)
    {
        $banners = $this->bannerService->create($request->validated());

        return $this->responses(StoreBannerResponseContract::class, $banners);
    }

    public function show($id)
    {
        $banner = $this->bannerService->show($id);

        return view('backoffice.pages.banners.edit', compact('banner'));
    }

    public function edit($id)
    {
        $banner = $this->bannerService->show($id);

        return view('backoffice.pages.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequestInterface $request, $id)
    {
        $banner = $this->bannerService->update($id, $request->validated());

        return $this->responses(UpdateBannerResponseContract::class, $banner);
    }

    public function destroy($id)
    {
        $this->bannerService->delete($id);

        return redirect()->route('bo.web.banners.index');
    }
}
