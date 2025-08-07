<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreCartResponseContract;
use App\Contracts\Responses\Backoffice\UpdateCartResponseContract;
use App\Http\Requests\Backoffice\Interfaces\StoreCartRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateCartRequestInterface;
use App\Models\Inventory;
use App\Models\User;
use App\Services\CartService;

class CartController extends BaseController
{
    protected $CartService;

    public function __construct(CartService $CartService)
    {
        $this->CartService = $CartService;
    }

    public function index()
    {
        return view('backoffice.pages.carts.index');
    }

    public function create()
    {
        $users = User::all();
        $inventories = Inventory::with('product')->get();
        return view('backoffice.pages.carts.create', compact('users', 'inventories'));
    }

    public function store(StoreCartRequestInterface $request)
    {
        $cart = $this->CartService->create($request->validated());

        return $this->responses(StoreCartResponseContract::class, $cart);
    }

    public function show($id)
    {
        $cart = $this->CartService->show($id);
        $users = User::all();
        $inventories = Inventory::with('product')->get();

        return view('backoffice.pages.carts.edit', compact('cart','users', 'inventories'));
    }

    public function update(UpdateCartRequestInterface $request, $id)
    {
        $cart = $this->CartService->update($id, $request->validated());

        return $this->responses(UpdateCartResponseContract::class, $cart);
    }

    public function destroy($id)
    {
        $this->CartService->delete($id);

        return redirect()->route('bo.web.carts.index');
    }
}
