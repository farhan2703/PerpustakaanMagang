<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;
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
                                <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square text-white"></i></button>
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
        DB::beginTransaction(); // Mulai transaksi sebelum try-catch

        try {            
            $role = PermissionRole::find($id);

            if (!$role) {
                DB::rollBack(); // Rollback jika terjadi error
                return redirect()->route('halaman.role')->with('error', 'Role tidak ditemukan.');
            }

            $permissions = Permission::pluck('name', 'id');
            $rolePermissions = $role->permissions->pluck('id')->toArray();

            DB::commit(); // Commit transaksi jika sukses
            return view('edit.editrolepermission', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            Log::error('Edit Role Error: ' . $e->getMessage());
            return redirect()->route('halaman.role')->with('error', 'Terjadi kesalahan saat mengedit role.');
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction(); // Mulai transaksi sebelum try-catch

        try {
            // Validasi hanya untuk permissions
            $request->validate([
                'permissions' => 'sometimes|array',
            ]);

            $role = PermissionRole::findOrFail($id);
            $role->name = $request->input('name', $role->name);
            $role->guard_name = $request->input('guard_name', $role->guard_name);
            $role->save();

            // Update permissions
            $role->syncPermissions($request->input('permissions', []));

            DB::commit(); // Commit transaksi jika sukses
            return redirect()->route('halaman.role')->with('success', 'Berhasil melakukan update permission');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            Log::error('Update Role Error: ' . $e->getMessage());
            return redirect()->route('halaman.role')->with('error', 'Terjadi kesalahan saat memperbarui role.');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        DB::beginTransaction(); // Mulai transaksi sebelum try-catch

        try {
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
            FacadesSession::put('currentRole', $defaultRole);

            DB::commit(); // Commit transaksi jika sukses
            return redirect()->intended('/home');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            Log::error('Authentication Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login.');
        }
    }

    public function switchRole($role)
    {
        DB::beginTransaction(); // Mulai transaksi sebelum try-catch

        try {
            // Validasi role yang valid jika diperlukan
            $validRoles = ['admin', 'member', 'admin,member'];
            if (!in_array($role, $validRoles)) {
                DB::rollBack(); // Rollback jika role tidak valid
                return redirect()->back()->withErrors('Invalid role');
            }

            // Set session untuk role
            session(['currentRole' => $role]);

            DB::commit(); // Commit transaksi jika sukses
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            Log::error('Switch Role Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengganti role.');
        }
    }
}