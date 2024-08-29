<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Member;
use App\Models\PeminjamanPengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('auth.member-login');
    }

    /**
     * Proses login member.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect()->route('member.dashboard');
        }

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
        $jumlahBukuDipinjam = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
            ->join('buku', 'peminjaman_pengembalian.buku_id', '=', 'buku.id_buku')
            ->count('buku.stok');

        return response()->json(['jumlah' => $jumlahBukuDipinjam]);
    }

    public function totalBuku(Request $request)
    {
        $jumlahBukuTersedia = Buku::where('stok', '>', 0)->sum('stok');
        $jumlahBukuDipinjam = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
            ->join('buku', 'peminjaman_pengembalian.buku_id', '=', 'buku.id_buku')
            ->count('buku.stok');

        $totalBuku = $jumlahBukuTersedia + $jumlahBukuDipinjam;

        return response()->json(['total' => $totalBuku]);
    }

    public function getChartData(Request $request)
    {
        $jumlahBukuTersedia = Buku::where('stok', '>', 0)->sum('stok');
        $jumlahBukuDipinjam = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
            ->join('buku', 'peminjaman_pengembalian.buku_id', '=', 'buku.id_buku')
            ->count('buku.stok');

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
                ->addIndexColumn()
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex justify-content-center align-items-center">
                            <form action="/member/' . $row->id_member . '/edit_member" method="GET" class="me-1">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square text-white"></i></button>
                            </form>
                            <form action="/member/' . $row->id_member . '/destroy" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['opsi'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('tambah.tambahmember');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'email' => 'required|string|max:255|unique:member,email',
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

            DB::commit();

            return redirect()->route('halaman.member')->with('success', 'Member berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan member.']);
        }
    }

    public function edit($id_member)
    {
        $member = Member::findOrFail($id_member);
        return view('edit.editmember', compact('member'));
    }

    public function update(Request $request, $id_member)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'email' => 'required|string|max:255|unique:member,email,' . $id_member . ',id_member',
            ], [
                'email.unique' => 'Email sudah digunakan. Silakan gunakan email lain.',
            ]);

            $member = Member::findOrFail($id_member);

            $member->nama = $request->input('nama');
            $member->no_telepon = $request->input('no_telepon');
            $member->email = $request->input('email');

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8',
                ]);
                $member->password = bcrypt($request->input('password'));
            }

            $member->save();

            DB::commit();

            return redirect()->route('halaman.member')->with('success', 'Member berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate member.']);
        }
    }

    public function forcedelete($id_member)
    {
        DB::beginTransaction();

        try {
            $member = Member::find($id_member);

            if (!$member) {
                return Redirect::route('halaman.member')->with('error', 'Member tidak ditemukan.');
            }

            $member->delete();

            DB::commit();

            return Redirect::route('halaman.member')->with('success', 'Member berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::route('halaman.member')->with('error', 'Terjadi kesalahan saat menghapus member.');
        }
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('edit.editprofile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        DB::beginTransaction();

        try {
            $member = Auth::user();

            $request->validate([
                'nama' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'email' => 'required|string|email|max:255|unique:member,email,' . $member->id_member . ',id_member',
                'password' => 'nullable|string|min:8|confirmed',
                'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $member->nama = $request->nama;
            $member->no_telepon = $request->no_telepon;
            $member->email = $request->email;

            if ($request->filled('password')) {
                $member->password = Hash::make($request->password);
            }

            if ($request->hasFile('foto_profil')) {
                if ($member->foto_profil && Storage::exists($member->foto_profil)) {
                    Storage::delete($member->foto_profil);
                }

                $path = $request->file('foto_profil')->store('profile_pictures', 'public');
                $member->foto_profil = $path;
            }

            $member->save();

            DB::commit();

            return redirect()->route('editprofile')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui profil.']);
        }
    }
}