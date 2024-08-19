<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Member::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('halaman.dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {   
         // Hapus session currentRole saat logout
         Session::forget('currentRole');

         Auth::logout();
 
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect('/');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:member,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $member = Member::create([
            'nama' => $request->name,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]);
            $member->assignRole('Member');
        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
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

    // Default redirect jika role tidak dikenali
    return redirect()->route('home');
}

    
    // /**
    //  * Menampilkan form login.
    //  */
    // public function showLoginForm()
    // {
    //     return view('auth.login'); // Pastikan ada view login.blade.php
    // }

    // /**
    //  * Proses login.
    //  */
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     // Cek di tabel Admin
    //     if (Admin::where('email', $request->email)->exists() && Auth::guard('admin')->attempt($credentials)) {
    //         return redirect()->route('admin.dashboard'); // Ganti dengan route admin dashboard
    //     }

    //     // Cek di tabel Member
    //     if (Member::where('email', $request->email)->exists() && Auth::guard('member')->attempt($credentials)) {
    //         return redirect()->route('member.dashboard'); // Ganti dengan route member dashboard
    //     }

    //     // Jika login gagal
    //     return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
    // }

    // /**
    //  * Proses logout.
    //  */
    // public function logout(Request $request)
    // {
    //     // Logout dari guard yang sedang digunakan
    //     Auth::guard('admin')->logout();
    //     Auth::guard('member')->logout();

    //     return redirect()->route('login'); // Pastikan route login sesuai
    // }

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:100',
    //         'no_telepon' => 'required|string|max:20',
    //         'email' => 'required|email|unique:members,email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     Member::create([
    //         'nama' => $request->name,
    //         'no_telepon' => $request->no_telepon,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    // }
}