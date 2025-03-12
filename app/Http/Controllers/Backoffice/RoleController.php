<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreRoleResponseContract;
use App\Contracts\Responses\Backoffice\UpdateRoleResponseContract;
use App\Http\Requests\Interfaces\StoreRoleRequestInterface;
use App\Http\Requests\Interfaces\UpdateRoleRequestInterface;
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
        // Lấy tất cả permissions từ cơ sở dữ liệu
        $permissions = Permission::all()->pluck('name')->toArray();

        // Tổ chức permissions thành mảng phân cấp
        $groups = [];
        foreach ($permissions as $permission) {
            $parts = explode('.', $permission, 2); // Tách thành 2 phần: nhóm cha và phần còn lại
            if (count($parts) === 2) {
                $groupName = $parts[0]; // Phần đầu là tên nhóm (ví dụ: "customers")
                $subPermission = $permission; // Toàn bộ permission (ví dụ: "customers.list")
                if (!isset($groups[$groupName])) {
                    $groups[$groupName] = [];
                }
                $groups[$groupName][] = $subPermission; // Gán permission vào nhóm
            } else {
                // Nếu không có phần con, đặt trực tiếp vào nhóm cha
                $groups[$permission] = [$permission];
            }
        }

        // Sắp xếp các nhóm và item con theo thứ tự alphabet
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
        $admin = $this->roleService->show($id);
        return view('backoffice.pages.admins.show', compact('admin', 'roles', 'adminRoleIds'));
    }

    public function edit($id)
    {
        $admin = $this->roleService->find($id);
        return view('backoffice.pages.admins.edit', compact('admin', 'roles', 'adminRoleIds'));
    }

    public function update(UpdateRoleRequestInterface $request, string $id)
    {
        $admin = $this->roleService->update($id, $request->validated());
        return $this->responses(UpdateRoleResponseContract::class, $admin);
    }

    public function destroy(string $id)
    {
        $this->roleService->delete($id);
        return redirect()->route('bo.web.admins.index');
    }
}