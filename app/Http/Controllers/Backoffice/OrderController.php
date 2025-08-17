<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreOrderResponseContract;
use App\Contracts\Responses\Backoffice\UpdateOrderResponseContract;
use App\Enum\AccessChannelEnum;
use App\Enum\AccessChannelOptions;
use App\Enum\OrderStatusEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreOrderRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateOrderRequestInterface;
use App\Models\District;
use App\Models\Inventory;
use App\Models\PaymentOption;
use App\Models\Province;
use App\Models\ShippingOption;
use App\Models\User;
use App\Models\Ward;
use App\Services\InventoryService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
   protected $orderService;
   protected $inventoryService;

    public function __construct(OrderService $orderService, InventoryService $inventoryService)
    {
        $this->orderService = $orderService;
        $this->inventoryService = $inventoryService;
    }

    public function index()
    {
        $orderStatusEnumLabels = OrderStatusEnum::labels();
        return view('backoffice.pages.orders.index', compact('orderStatusEnumLabels'));
    }

    public function create()
    {
        $users = User::select('id', 'name', 'email', 'phone_number')->where('status', 1)->get();
        $accessChannelTypeLables = AccessChannelOptions::labels();
        $inventories = $this->inventoryService->getActiveInventoriesWithFinalPrice();
        $provinces = Province::all();
        $districts = District::all(); 
        $wards = Ward::all(); 
        $shippingOptions = ShippingOption::all();
        $paymentOptions = PaymentOption::all();
        
        return view('backoffice.pages.orders.create', compact('users', 'accessChannelTypeLables', 'inventories', 'provinces', 'districts', 'wards', 'paymentOptions', 'shippingOptions'));
    }

    public function store(StoreOrderRequestInterface $request)
    {
        $order = $this->orderService->create($request->validated());

        return $this->responses(StoreOrderResponseContract::class, $order);
    }

    public function show($id)
    {
        $order = $this->orderService->show($id);
        $accessChannelTypeLables = AccessChannelOptions::labels();

        return view('backoffice.pages.orders.edit', [
            'order' => $order,
            'orderService' => $this->orderService,
            'accessChannelTypeLables' => $accessChannelTypeLables,
        ]);
    }

    public function edit($id)
    {
        $order = $this->orderService->show($id);
        $accessChannelTypeLables = AccessChannelOptions::labels();

        return view('backoffice.pages.orders.edit', [
            'order' => $order,
            'orderService' => $this->orderService,
            'accessChannelTypeLables' => $accessChannelTypeLables,
        ]);
    }


    public function update(UpdateOrderRequestInterface $request, $id)
    {
        $order = $this->orderService->update($id, $request->validated());

        return $this->responses(UpdateOrderResponseContract::class, $order);
    }

    public function destroy($id)
    {
        $this->orderService->delete($id);

        return redirect()->route('bo.web.pages.orders.index');
    }
}
