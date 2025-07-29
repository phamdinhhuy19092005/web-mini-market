<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreBannerResponseContract;
use App\Contracts\Responses\Backoffice\UpdateBannerResponseContract;
use App\Http\Requests\Backoffice\Interfaces\StoreBannerRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\StoreCartRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateBannerRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCartRequestInterface;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    protected $BannerService;

    public function __construct(CartService $BannerService)
    {
        $this->BannerService = $BannerService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.carts.index');
    }

    public function create()
    {
        return view('backoffice.pages.carts.create');
    }

    public function store(StoreCartRequestInterface $request)
    {
        $banners = $this->BannerService->create($request->validated());

        return $this->responses(StoreBannerResponseContract::class, $banners);
    }

    public function show($id)
    {
        $banner = $this->BannerService->show($id);

        return view('backoffice.pages.carts.edit', compact('banner'));
    }

    public function update(UpdateCartRequestInterface $request, $id)
    {
        $banner = $this->BannerService->update($id, $request->validated());

        return $this->responses(UpdateBannerResponseContract::class, $banner);
    }

    public function destroy($id)
    {
        $this->BannerService->delete($id);

        return redirect()->route('bo.web.carts.index');
    }
}
