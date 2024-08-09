<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan form pendaftaran.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $member = Member::create([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $member->assignRole('Member');

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
