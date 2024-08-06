<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar admin dengan pagination.
     */
    public function admin()
    {
        $admins = Admin::paginate(10); // Mengambil data dengan pagination
        return view('halaman.admin', compact('admins')); // Mengirim data admin ke view
    }

    /**
     * Menampilkan formulir untuk menambahkan admin baru.
     */
    public function create()
    {
        return view('tambah.tambahadmin'); // Mengembalikan view untuk menambah admin
    }

    /**
     * Menyimpan admin baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin',
            'password' => 'required|string|min:8',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|string'
        ]);

        // Buat admin baru
        Admin::create([
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Enkripsi password
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->route('halaman.admin')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit data admin.
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id); // Mengambil data admin berdasarkan ID
        return view('edit.admin', compact('admin')); // Mengirim data admin ke view
    }

    /**
     * Memperbarui data admin di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin,username,' . $id . ',id_admin',
            'password' => 'nullable|string|min:8', // Password opsional saat edit
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|string'
        ]);

        // Temukan admin berdasarkan ID
        $admin = Admin::findOrFail($id);

        // Update admin
        $admin->update([
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
            'password' => $request->password ? bcrypt($request->password) : $admin->password, // Update password jika ada
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        // Redirect ke halaman admin dengan pesan sukses
        return redirect()->route('halaman.admin')->with('success', 'Admin berhasil diperbarui.');
    }
}