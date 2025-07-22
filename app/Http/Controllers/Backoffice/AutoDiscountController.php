<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Enum\DiscountTypeEnum;
use App\Services\AutoDiscountService;
use App\Contracts\Responses\Backoffice\StoreAutoDiscountResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAutoDiscountResponseContract;
use App\Enum\DiscountConditionTypeEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreAutoDiscountRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAutoDiscountRequestInterface;

class AutoDiscountController extends BaseController
{
    protected $autoDiscountService;

    public function __construct(AutoDiscountService $autoDiscountService)
    {
        $this->autoDiscountService = $autoDiscountService;
    }

    public function index(Request $request)
    {
        return view('backoffice.pages.auto-discounts.index');
    }

    public function create()
    {
        $DiscountTypeEnumLabes = DiscountTypeEnum::labels();
        $DiscountConditionTypeEnumLables = DiscountConditionTypeEnum::labels();

        return view('backoffice.pages.auto-discounts.create', compact('DiscountTypeEnumLabes', 'DiscountConditionTypeEnumLables'));
    }

    public function store(StoreAutoDiscountRequestInterface $request)
    {
        $autoDiscount = $this->autoDiscountService->create($request->validated());

        return $this->responses(StoreAutoDiscountResponseContract::class, $autoDiscount);
    }

    public function show($id)
    {
        $autoDiscount = $this->autoDiscountService->show($id);
        $DiscountTypeEnumLabes = DiscountTypeEnum::labels();
        $DiscountConditionTypeEnumLables = DiscountConditionTypeEnum::labels();

        return view('backoffice.pages.auto-discounts.edit', compact('autoDiscount','DiscountTypeEnumLabes', 'DiscountConditionTypeEnumLables'));
    }

    public function edit($id)
    {
        $autoDiscount = $this->autoDiscountService->show($id);
        $DiscountTypeEnumLabes = DiscountTypeEnum::labels();
        $DiscountConditionTypeEnumLables = DiscountConditionTypeEnum::labels();

        return view('backoffice.pages.auto-discounts.edit', compact('autoDiscount','DiscountTypeEnumLabes', 'DiscountConditionTypeEnumLables'));
    }

    public function update(UpdateAutoDiscountRequestInterface $request, $id)
    {
        $autoDiscount = $this->autoDiscountService->update($id, $request->validated());

        return $this->responses(UpdateAutoDiscountResponseContract::class, $autoDiscount);
    }

    public function destroy($id)
    {
        $this->autoDiscountService->delete($id);

        return redirect()->route('bo.web.auto-discounts.index');
    }

}
