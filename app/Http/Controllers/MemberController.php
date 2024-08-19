<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\PeminjamanPengembalian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
    public function jumlahbukutersedia(Request $request)
    {
        $jumlahBukuTersedia = Buku::where('stok', '>', 0)->sum('stok');
        return response()->json(['jumlah' => $jumlahBukuTersedia]);
    }
    public function jumlahBukuDipinjam(Request $request)
    {
    // Menghitung total stok buku yang dipinjam
    $jumlahBukuDipinjam = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
        ->join('buku', 'peminjaman_pengembalian.buku_id', '=', 'buku.id_buku')
        ->count('buku.stok');

    return response()->json(['jumlah' => $jumlahBukuDipinjam]);
    }
    public function totalBuku(Request $request)
    {
        // Menghitung total jumlah buku dari yang tersedia dan yang dipinjam
        $jumlahBukuTersedia = Buku::where('stok', '>', 0)->sum('stok');
        $jumlahBukuDipinjam = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
            ->join('buku', 'peminjaman_pengembalian.buku_id', '=', 'buku.id_buku')
            ->count('buku.stok');

        $totalBuku = $jumlahBukuTersedia + $jumlahBukuDipinjam;

        return response()->json(['total' => $totalBuku]);
    }
    public function getChartData(Request $request)
    {
        // Menghitung total stok buku yang tersedia
        $jumlahBukuTersedia = Buku::where('stok', '>', 0)->sum('stok');

        // Menghitung total buku yang dipinjam
        $jumlahBukuDipinjam = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
            ->join('buku', 'peminjaman_pengembalian.buku_id', '=', 'buku.id_buku')
            ->count('buku.stok');

        // Menghitung total buku dari buku yang tersedia dan buku yang dipinjam
        $totalBuku = $jumlahBukuTersedia + $jumlahBukuDipinjam;

        return response()->json([
            'tersedia' => $jumlahBukuTersedia,
            'dipinjam' => $jumlahBukuDipinjam,
            'total' => $totalBuku
        ]);
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