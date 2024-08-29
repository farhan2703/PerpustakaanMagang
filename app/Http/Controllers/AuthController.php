<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika pengguna sudah login, arahkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('halaman.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $user = Member::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);

                // Panggil authenticated untuk mengatur role
                $this->authenticated($request, $user);

                return redirect()->route('halaman.dashboard');
            }

            return redirect()->back()->withErrors(['message' => 'Anda Gagal Melakukan Login']);
        } catch (\Exception $e) {
            // Log error atau tangani sesuai kebutuhan
            Log::error('Login Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Something went wrong during login']);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } catch (\Exception $e) {
            // Log error atau tangani sesuai kebutuhan
            Log::error('Logout Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Logout failed']);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|unique:member,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $member = Member::create([
                    'nama' => $request->name,
                    'no_telepon' => $request->no_telepon,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $member->assignRole('Member');
            });

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silahkan melakukan Login.');
        } catch (\Exception $e) {
            // Log error atau tangani sesuai kebutuhan
            Log::error('Registration Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Anda Gagal pembuatan akun']);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        // Set default role after successful login
        $defaultRole = $this->determineDefaultRole($user);
        Session::put('currentRole', $defaultRole);

        // Redirect ke dashboard setelah login
        return redirect()->route('halaman.dashboard');
    }

    protected function determineDefaultRole($user)
    {
        // Ambil semua role user
        $roles = $user->getRoleNames()->toArray();

        // Tentukan role default berdasarkan nama role
        if (in_array('Admin', $roles)) {
            return 'admin';
        } elseif (in_array('Member', $roles)) {
            return 'member';
        } else {
            return 'member'; // Default role jika tidak ada yang cocok
        }
    }
}