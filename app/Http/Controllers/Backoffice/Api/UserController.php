<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListUserResponseContract;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    public function __construct(protected UserService $userService)
    {
        //
    }

    public function index(Request $request)
    {
        $users = $this->userService->searchByAdmin($request->all());

        return $this->responses(ListUserResponseContract::class, $users);
    }
}
