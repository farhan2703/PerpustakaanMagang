<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}