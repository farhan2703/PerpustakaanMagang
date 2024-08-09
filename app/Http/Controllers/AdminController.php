<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function admin()
    {
        $admins = Admin::paginate(10);
        return view('halaman.admin', compact('admins'));
    }

    public function create()
    {
        return view('tambah.tambahadmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:admin',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
        ]);

        Admin::create([
            'nama_admin' => $request->input('nama_admin'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            
        ]);

        return redirect()->route('halaman.admin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('edit.editadmin', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:admin,email,' . $id . ',id_admin',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->update([
            'nama_admin' => $request->input('nama_admin'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),

        ]);

        return redirect()->route('halaman.admin')->with('success', 'Admin berhasil diupdate!');
    }
    public function forcedelete($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return Redirect::route('halaman.admin')->with('error', 'Admin tidak ditemukan.');
        }

        $admin->delete();

        return Redirect::route('halaman.admin')->with('success', 'Admin berhasil dihapus.');
    }
}