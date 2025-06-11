<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAdminResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAdminResponseContract;
use App\Http\Requests\Interfaces\StoreAdminRequestInterface;
use App\Http\Requests\Interfaces\UpdateAdminRequestInterface;
use App\Models\Role;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return view('backoffice.pages.admins.index');
    }

    public function create()
    {
        $roles = Role::all();

        return view('backoffice.pages.admins.create', compact('roles'));
    }

    public function store(StoreAdminRequestInterface $request)
    {
        $admin = $this->adminService->create($request->validated());

        return $this->responses(StoreAdminResponseContract::class, $admin);
    }

    public function show($id)
    {
        $admin = $this->adminService->show($id);
        $roles = Role::all();
        $adminRoleIds = $admin->roles->pluck('id')->toArray();

        return view('backoffice.pages.admins.show', compact('admin', 'roles', 'adminRoleIds'));
    }

    public function edit($id)
    {
        $admin = $this->adminService->find($id);
        $roles = Role::all();
        $adminRoleIds = $admin->roles->pluck('id')->toArray();

        return view('backoffice.pages.admins.edit', compact('admin', 'roles', 'adminRoleIds'));
    }

    public function update(UpdateAdminRequestInterface $request, string $id)
    {
        $admin = $this->adminService->update($id, $request->validated());

        return $this->responses(UpdateAdminResponseContract::class, $admin);
    }

    public function destroy(string $id)
    {
        $this->adminService->delete($id);
        
        return redirect()->route('bo.web.admins.index');
    }
}