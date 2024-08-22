<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{   
    public function dashboard()
    {
        return view('member.dashboard');
    }
    public function admin(Request $request)
    {
        return view('halaman.admin');
    }

    public function tableAdmin(Request $request)
{
    if ($request->ajax()) {
        $members = Member::role('Admin')
            ->with('roles')
            ->select(['id_member', 'nama', 'no_telepon', 'email'])->get();

        return DataTables::of($members)
            ->addIndexColumn() // Menambahkan indeks otomatis
            ->addColumn('opsi', function ($row) {
                return '
                    <div class="d-flex justify-content-center align-items-center">
                        <form action="/admin/' . $row->id_member . '/edit_admin" method="GET" class="me-2">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square text-white"></i>
                            </button>
                        </form>
                        <form action="/admin/' . $row->id_member . '/destroy" method="POST">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['opsi']) // Pastikan kolom ini dianggap sebagai HTML
            ->make(true);
    }
}


    public function create()
    {
        return view('tambah.tambahadmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|string|max:255|unique:member,email', // Validasi untuk memastikan email unik di tabel 'member'
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'Email sudah digunakan. Silakan gunakan email lain.',
        ]);

        $member = Member::create([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $member->assignRole('Admin');

        return redirect()->route('halaman.admin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id_member)
    {
        $member = Member::findOrFail($id_member);
        return view('edit.editadmin', compact('member'));
    }

    public function update(Request $request, $id_member)
    {$request->validate([
        'nama' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:15',
        'email' => 'required|string|max:255|unique:member,email,' . $id_member . ',id_member', // Validasi untuk memastikan email unik di tabel 'member' kecuali untuk ID yang sedang diedit
    ], [
        'email.unique' => 'Email sudah digunakan. Silakan gunakan email lain.',
    ]);

    $member = Member::findOrFail($id_member);

    // Update fields
    $member->nama = $request->input('nama');
    $member->no_telepon = $request->input('no_telepon');
    $member->email = $request->input('email');

    // Cek apakah password diisi
    if ($request->filled('password')) {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);
        $member->password = bcrypt($request->input('password'));
    }

    $member->save();

    return redirect()->route('halaman.admin')->with('success', 'Admin berhasil diupdate!');
}
    public function forcedelete($id_member)
    {
        $member = Member::find($id_member);

        if (!$member) {
            return Redirect::route('halaman.admin')->with('error', 'Admin tidak ditemukan.');
        }

        $member->delete();

        return Redirect::route('halaman.admin')->with('success', 'Admin berhasil dihapus.');
    }
}