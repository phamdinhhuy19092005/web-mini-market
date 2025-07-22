<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreUserResponseContract;
use App\Contracts\Responses\Backoffice\UpdateUserResponseContract;
use App\Enum\AccessChannelEnum;
use App\Enum\ActivationStatusEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreUserRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateUserRequestInterface;
use App\Services\UserService;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('backoffice.pages.users.index');
    }

    public function create()
    {
        return view('backoffice.pages.users.create');
    }

    public function store(StoreUserRequestInterface $request)
    {
        $user = $this->userService->create($request->validated());
        return $this->responses(StoreUserResponseContract::class, $user);
    }

    public function show($id)
    {
        $user = $this->userService->show($id);
        $activationStatus = ActivationStatusEnum::class;
        $accessChannelTypeLables = AccessChannelEnum::labels();
        
        return view('backoffice.pages.users.edit', compact('user', 'activationStatus', 'accessChannelTypeLables'));
    }

    public function update(UpdateUserRequestInterface $request, string $id)
    {
        $user = $this->userService->update($id, $request->validated());

        return $this->responses(UpdateUserResponseContract::class, $user);
    }

    public function destroy(string $id)
    {
        $this->userService->delete($id);

        return redirect()->route('users.index');
    }

    public function deactivate($id)
    {
        $this->userService->changeStatus($id, ActivationStatusEnum::INACTIVE, 'Admin đã vô hiệu hóa');
        return response()->json(['message' => 'Đã vô hiệu hóa']);
    }

    public function activate($id)
    {
        $this->userService->changeStatus($id, ActivationStatusEnum::ACTIVE, 'Admin đã kích hoạt');
        return response()->json(['message' => 'Đã kích hoạt']);
    }


}
