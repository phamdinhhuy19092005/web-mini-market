<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreRoleResponseContract;
use App\Contracts\Responses\Backoffice\UpdateRoleResponseContract;

use App\Http\Requests\Backoffice\Interfaces\StoreRoleRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateRoleRequestInterface;

use App\Services\RoleService;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        return view('backoffice.pages.roles.index');
    }

    public function create()
    {
        $permissions = Permission::all()->pluck('name')->toArray();

        $groups = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission, 2);
            if (count($parts) === 2) {
                $groupName = $parts[0]; 
                $subPermission = $permission; 
                if (!isset($groups[$groupName])) {
                    $groups[$groupName] = [];
                }
                $groups[$groupName][] = $subPermission; 
            } else {
                
                $groups[$permission] = [$permission];
            }
        }

        ksort($groups);
        foreach ($groups as &$subPermissions) {
            sort($subPermissions);
        }

        return view('backoffice.pages.roles.create', compact('groups'));
    }

    public function store(StoreRoleRequestInterface $request)
    {
        $role = $this->roleService->create($request->validated());

        return $this->responses(StoreRoleResponseContract::class, $role);
    }

    public function show($id)
    {
        $role = $this->roleService->show($id);
        return view('backoffice.pages.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = $this->roleService->find($id);
        $permissions = Permission::all()->pluck('name')->toArray();

        $groups = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission, 2);
            $groupName = count($parts) === 2 ? $parts[0] : $permission;
            $groups[$groupName][] = $permission;
        }

        ksort($groups);
        foreach ($groups as &$subPermissions) {
            sort($subPermissions);
        }

        $rolePermissionNames = $role->permissions->pluck('name')->toArray();

        return view('backoffice.pages.roles.edit', compact('role', 'groups', 'rolePermissionNames'));
    }

    public function update(UpdateRoleRequestInterface $request, string $id)
    {
        $role = $this->roleService->update($id, $request->validated());
        return $this->responses(UpdateRoleResponseContract::class, $role);
    }

    public function destroy(string $id)
    {
        $this->roleService->delete($id);
        return redirect()->route('bo.web.roles.index');
    }

}