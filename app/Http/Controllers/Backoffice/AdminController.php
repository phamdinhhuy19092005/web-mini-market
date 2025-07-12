<?php

namespace App\Http\Controllers\Backoffice;

use App\Contracts\Responses\Backoffice\StoreAdminResponseContract;
use App\Contracts\Responses\Backoffice\UpdateAdminResponseContract;
use App\Http\Requests\Backoffice\Interfaces\StoreAdminRequestInterface;
use App\Http\Requests\Backoffice\Interfaces\UpdateAdminRequestInterface;
use App\Models\Role;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return redirect()->route('admins.index');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->name = $request->input('name');
        $admin->save();

        return redirect()->back()->with('success', 'Hồ sơ đã được cập nhật.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->input('password'), $admin->password)) {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $admin->password = Hash::make($request->input('new_password'));
        $admin->save();

        return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật.');
    }
}
