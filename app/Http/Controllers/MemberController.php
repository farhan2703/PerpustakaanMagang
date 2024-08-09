<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

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
    public function dashboard()
    {
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
            'email' => 'required|string|email|max:255|unique:members',
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
}