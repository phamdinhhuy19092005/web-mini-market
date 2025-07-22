<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCouponResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCouponResponseContract;
use App\Enum\DiscountTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreCouponRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCouponRequestInterface;

use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.coupons.index');
    }

    public function create()
    {
        $DiscountTypeEnumLabes = DiscountTypeEnum::labels();

        return view('backoffice.pages.coupons.create', compact('DiscountTypeEnumLabes'));
    }

    public function store(StoreCouponRequestInterface $request)
    {
        $coupon = $this->couponService->create($request->validated());

        return $this->responses(StoreCouponResponseContract::class, $coupon);
    }

    public function show($id)
    {
        $coupon = $this->couponService->show($id);
        $DiscountTypeEnumLabes = DiscountTypeEnum::labels();

        return view('backoffice.pages.coupons.edit', compact('coupon','DiscountTypeEnumLabes'));
    }

    public function edit($id)
    {
        $coupon = $this->couponService->show($id);
        $DiscountTypeEnumLabes = DiscountTypeEnum::labels();

        return view('backoffice.pages.coupons.edit', compact('coupon','DiscountTypeEnumLabes'));
    }

    public function update(UpdateCouponRequestInterface $request, $id)
    {
        $coupon = $this->couponService->update($id, $request->validated());

        return $this->responses(UpdateCouponResponseContract::class, $coupon);
    }

    public function destroy($id)
    {
        $this->couponService->delete($id);

        return redirect()->route('bo.web.coupons.index');
    }

}
