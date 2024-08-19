<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
<<<<<<< HEAD
use App\Models\PeminjamanPengembalian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
=======
>>>>>>> 979fa5ed7ed95eeb86ca65c6764f0377babfa120

class MemberController extends Controller
{
    /**
     * Menampilkan formulir login untuk member.
     */
    public function showLoginForm()
    {
        return view('auth.member-login'); // Pastikan ada view member-login.blade.php di folder resources/views/auth
    }

    /**
     * Proses login member.
     */
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('member')->attempt($credentials)) {
        // Authenticated
        return redirect()->route('member.dashboard');
    }

    // If authentication fails
    return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
}

    /**
     * Menampilkan dashboard member.
     */
    public function dashboard(Request $request)
    {
        // dd(Auth::user()->getAllPermissions());
        // Hanya member yang terautentikasi yang dapat mengakses dashboard ini
        return view('member.dashboard'); // Pastikan ada view member/dashboard.blade.php
    }

    public function index()
    {
        // Hanya member yang terautentikasi yang dapat mengakses dashboard ini
        return view('halaman.member'); // Pastikan ada view member/dashboard.blade.php
    }

    /**
     * Menampilkan formulir untuk menambahkan member baru.
     */
    public function create()
    {
        return view('member.create'); // Pastikan ada view member/create.blade.php di folder resources/views/member
    }

    /**
     * Menyimpan member baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:member',
            'password' => 'required|string|min:8',
        ]);

        // Buat member baru
        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);

        // Redirect ke dashboard member dengan pesan sukses
        return redirect()->route('member.dashboard')->with('success', 'Member berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit data member.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id); // Mengambil data member berdasarkan ID
        return view('member.edit', compact('member')); // Pastikan ada view member/edit.blade.php di folder resources/views/member
    }

    /**
     * Memperbarui data member di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $id,
            'password' => 'nullable|string|min:8', // Password opsional saat edit
        ]);

        // Temukan member berdasarkan ID
        $member = Member::findOrFail($id);

        // Update member
        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $member->password, // Update password jika ada
        ]);

        // Redirect ke dashboard member dengan pesan sukses
        return redirect()->route('member.dashboard')->with('success', 'Member berhasil diperbarui.');
    }

    /**
     * Logout member.
     */
    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('login'); // Redirect ke halaman login setelah logout
    }
<<<<<<< HEAD
    
    public function editProfile()
    {
        $user = Auth::user(); // Mengambil user yang sedang login
        return view('edit.editprofile', compact('user'));
    }

    public function updateProfile(Request $request)
{
        $member = Auth::user();

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:member,email,' . $member->id_member . ',id_member',
            'password' => 'nullable|string|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data
        $member->nama = $request->nama;
        $member->no_telepon = $request->no_telepon;
        $member->email = $request->email;

        if ($request->filled('password')) {
            $member->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profil')) {
            // Hapus foto profil lama jika ada
            if ($member->foto_profil && Storage::exists($member->foto_profil)) {
                Storage::delete($member->foto_profil);
            }

            // Simpan foto profil baru
            $path = $request->file('foto_profil')->store('uploads/profiles', 'public');
            $member->foto_profil = $path;
        }

        $member->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }

    
}
=======
}

>>>>>>> 979fa5ed7ed95eeb86ca65c6764f0377babfa120
