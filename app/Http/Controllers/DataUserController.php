<?php

namespace App\Http\Controllers;


use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DataUserController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        return view('member.dashboard');
    }
    
    public function datauser(Request $request)
    {
        return view('halaman.datauser');
    }
    public function tableUser(Request $request)
{
    if ($request->ajax()) {
        $members = Member::whereHas('roles', function($query) {
            $query->whereIn('name', ['Admin', 'Member']);
        })
        ->with('roles')
        ->select(['id_member', 'nama', 'no_telepon', 'email'])
        ->get();

        return DataTables::of($members)
            ->addIndexColumn() // Menambahkan indeks otomatis
            ->addColumn('roles', function ($row) {
                // Menggabungkan semua nama peran yang dimiliki oleh member
                return $row->roles->pluck('name')->join(', ');
            })
            ->addColumn('opsi', function ($row) {
                return '
                     <div class="d-flex justify-content-center align-items-center">
                        <form action="/datauser/' . $row->id_member . '/edit_datauser" method="GET" class="me-2">
                             <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square text-white"></i></button>
                        </form>
                        <form action="/datauser/' . $row->id_member . '/destroy" method="POST">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['opsi']) // Pastikan kolom ini dianggap sebagai HTML
            ->make(true);
    }
}
    public function edit($id_member)
    {
        // Cari member berdasarkan id_member
        $member = Member::where('id_member', $id_member)->firstOrFail();
        $roles = Role::all(); // Mendapatkan semua role
        $memberRoles = $member->roles->pluck('name')->toArray(); // Mendapatkan role yang dimiliki oleh member saat ini

        return view('edit.editdatauser', compact('member', 'roles', 'memberRoles'));
    }

    public function updateRole(Request $request, $id_member)
    {
        // Cari member berdasarkan id_member
        $member = Member::where('id_member', $id_member)->firstOrFail();

        // Validasi input
        $request->validate([
            'roles' => 'required|array' // Pastikan setidaknya satu role dipilih
        ]);

        // Sinkronisasi role
        $roles = $request->input('roles');
        $member->syncRoles($roles);

        return redirect()->route('halaman.datauser')->with('success', 'Role akun tersebut berhasil diubah !');
    }
    public function destroy($id_member)
{
    // Cari member berdasarkan id_member
    $member = Member::where('id_member', $id_member)->firstOrFail();

    // Hapus member
    $member->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('halaman.datauser')->with('success', 'Akun tersebut berhasil dihapus !');
}


}