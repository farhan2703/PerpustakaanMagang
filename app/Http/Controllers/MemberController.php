<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

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
        return view('member.dashboard');
    }
    public function member(Request $request)
    {
        return view('halaman.member');
    }

    public function table(Request $request)
    {
        if ($request->ajax()) {
            $members = Member::role('Member')
            ->with('roles')
            ->select(['id_member', 'nama', 'no_telepon', 'email'])->get();

            return DataTables::of($members)
                ->addIndexColumn() // Menambahkan indeks otomatis
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex align-items-center">
                            <form action="/member/' . $row->id_member . '/edit_member" method="GET" class="mr-1">
                                <button type="submit" class="btn btn-warning btn-xs"><i class="bi bi-pencil-square"></i></button>
                            </form>
                            <form action="/member/' . $row->id_member . '/destroy" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i></button>
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
        return view('tambah.tambahmember');
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

        $member->assignRole('Member');

        return redirect()->route('halaman.member')->with('success', 'Member berhasil ditambahkan!');
    }

    public function edit($id_member)
    {
        $member = Member::findOrFail($id_member); // Menggunakan singular 'member' untuk variabel
        return view('edit.editmember', compact('member'));
    }

    public function update(Request $request, $id_member)
    {
        $request->validate([
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
    
        return redirect()->route('halaman.member')->with('success', 'Member berhasil diupdate!');
    }

    public function forcedelete($id_member)
    {
        $member = Member::find($id_member);
        

        if (!$member) {
            return Redirect::route('halaman.member')->with('error', 'Member tidak ditemukan.');
        }

        $member->delete();

        return Redirect::route('halaman.member')->with('success', 'Member berhasil dihapus.');
    }
    public function editProfile(){
        return view('edit.editprofile');
    }
}