<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListRoleResponseContract;
use App\Services\RoleService;
use Illuminate\Http\Request; 

class RoleController extends BaseApiController 
{
    public function __construct(protected RoleService $roleService)
    {
        //
    }

    public function index(Request $request)
    {
        $admins = $this->roleService->searchByAdmin($request->all());
        return $this->responses(ListRoleResponseContract::class, $admins);
    }
}
