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

    public function show($id)
{
    $user = $this->userService->show($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user);
}


    public function index(Request $request)
    {
        $users = $this->userService->searchByAdmin($request->all());

        return $this->responses(ListUserResponseContract::class, $users);
    }
}
