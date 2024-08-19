<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as PermissionRole;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function dashboard()
    {
        return view('member.dashboard');
    }

    public function role(Request $request)
    {
        return view('halaman.role');
    }

    public function tableRole(Request $request)
    {
        if ($request->ajax()) {
            $roles = PermissionRole::select(['id', 'name', 'guard_name'])->get();

            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex align-items-center">
                            <form action="' . route('role.edit', $row->id) . '" method="GET" class="mr-1">
                                <button type="submit" class="btn btn-warning btn-xs"><i class="bi bi-pencil-square"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['opsi'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $role = PermissionRole::findOrFail($id);
        $permissions = Permission::all(); // Mendapatkan semua permissions untuk checkbox
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('edit.editrolepermission', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = PermissionRole::findOrFail($id);
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $role->save();

        // Update permissions
        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('halaman.role')->with('success', 'Role updated successfully');
    }

    protected function authenticated(Request $request, $user)
    {
        // Ambil semua role user
        $roles = $user->getRoleNames()->toArray();

        // Tentukan role default berdasarkan peran yang dimiliki
        if (in_array('admin', $roles) && in_array('member', $roles)) {
            $defaultRole = 'admin,member';
        } elseif (in_array('admin', $roles)) {
            $defaultRole = 'admin';
        } elseif (in_array('member', $roles)) {
            $defaultRole = 'member';
        } else {
            $defaultRole = 'member'; // Default role jika tidak ada yang cocok
        }

        // Set session 'currentRole' ke role default
        Session::put('currentRole', $defaultRole);  

        // Redirect ke halaman yang dimaksud
        return redirect()->intended('/home');
    }
    public function switchRole($role)
    {
        // Validasi role yang valid jika diperlukan
        $validRoles = ['admin', 'member', 'admin,member'];
        if (!in_array($role, $validRoles)) {
            return redirect()->back()->withErrors('Invalid role');
        }

        // Set session untuk role
        session(['currentRole' => $role]);

        return redirect()->back();
    }

}