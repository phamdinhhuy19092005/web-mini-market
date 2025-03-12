<?php

namespace App\Http\Controllers\Backoffice\Api;

use App\Contracts\Responses\Backoffice\ListAdminResponseContract;
use App\Services\AdminService;
use Illuminate\Http\Request; 

class AdminController extends BaseApiController 
{
    public function __construct(protected AdminService $adminService)
    {
        //
    }

    public function index(Request $request)
    {
        $admins = $this->adminService->searchByAdmin($request->all());
        return $this->responses(ListAdminResponseContract::class, $admins);
    }
}
