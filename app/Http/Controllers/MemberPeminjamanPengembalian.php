<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanPengembalian;
use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class MemberPeminjamanPengembalian extends Controller
{
    public function indexPeminjamanmember()
    {
        return view('halaman.peminjamanmember');
    }

    public function tablePeminjamanMember(Request $request)
{
    if ($request->ajax()) {
        $userName = $request->get('user_name'); // Get user name from request

        $peminjamans = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
            ->whereHas('member', function ($query) use ($userName) {
                $query->where('nama', $userName);
            })
            ->with(['buku', 'member'])
            ->get();
            
        return DataTables::of($peminjamans)
            ->addIndexColumn()
            ->addColumn('judul_buku', function ($row) {
                return $row->buku ? $row->buku->judul : 'N/A';
            })
            ->addColumn('nama_member', function ($row) {
                return $row->member ? $row->member->nama : 'N/A';
            })
            ->addColumn('opsi', function ($row) {
                return '
                    <div class="d-flex align-items-center">
                        <form action="/peminjaman/' . $row->id . '/detail" method="GET" class="me-1">
                            <button type="submit" class="btn btn-secondary btn-xs"><i class="bi bi-info-circle"></i></button>
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <form action="/peminjamanmember/' . $row->id . '/edit_peminjamanmember" method="GET" >
                                <button type="submit" class="btn btn-warning btn-xs"><i class="ri-contacts-book-upload-line""></i></button>
                            </form>
                    </div>
                    
                ';
            })
            ->rawColumns(['opsi'])
            ->make(true);
        }
    }
    public function showDetail($id)
    {
        // Mendapatkan data peminjaman berdasarkan ID
        $peminjaman = PeminjamanPengembalian::with(['buku', 'member'])->findOrFail($id);
    
        // Menampilkan tampilan detail dengan data peminjaman
        return view('halaman.detailpeminjamanmember', compact('peminjaman'));
    }
    
    public function edit($id)
    {
        // Menampilkan form untuk mengedit peminjaman yang ada
        $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
        $bukus = Buku::all();
        $member = Member::all();
        return view('edit.editpeminjamanmember', compact('peminjamanPengembalian', 'bukus', 'member'));
    }

    public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'buku_id' => 'required|exists:buku,id_buku',
        'member_id' => 'required|exists:member,id_member',
        'tanggal_peminjaman' => 'required|date',
        'tanggal_pengembalian' => 'nullable|date',
        'status' => 'required|in:Dalam Peminjaman,Telah Dikembalikan',
    ]);

    // Mengambil data peminjaman yang akan diupdate
    $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);

    // Ambil id_member berdasarkan input member_id
    $member = Member::find($request->input('member_id'));

    if (!$member) {
        return redirect()->route('peminjamanmember.edit', $id)
                         ->withInput()
                         ->with('error', 'Member tidak ditemukan!');
    }

    // Mengupdate data peminjaman yang ada
    $data = $request->all();

    // Menentukan status berdasarkan tanggal pengembalian
    $statusBaru = $data['status'];

    // Validasi status dan tanggal pengembalian
    if ($statusBaru === 'Dalam Peminjaman' && !empty($data['tanggal_pengembalian'])) {
        return redirect()->route('peminjamanmember.edit', $id)
                         ->withInput()
                         ->with('warning', 'Jika status adalah "Dalam Peminjaman", tanggal pengembalian tidak boleh diisi.');
    }

    if ($statusBaru === 'Telah Dikembalikan' && empty($data['tanggal_pengembalian'])) {
        return redirect()->route('peminjamanmember.edit', $id)
                         ->withInput()
                         ->with('error', 'Tanggal pengembalian harus diisi jika status diubah menjadi "Telah Dikembalikan".');
    }

    // Set member_id ke id_member yang ditemukan
    $data['member_id'] = $member->id_member;

    // Cek jika status berubah menjadi "Telah Dikembalikan"
    if ($statusBaru === 'Telah Dikembalikan' && $peminjamanPengembalian->status !== 'Telah Dikembalikan') {
        // Tambah stok buku yang dipinjam
        $buku = Buku::find($peminjamanPengembalian->buku_id);
        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }
    }

    // Set status baru
    $data['status'] = $statusBaru;

    // Update data peminjaman
    $peminjamanPengembalian->update($data);

    return redirect()->route('halaman.peminjamanmember')->with('success', 'Data berhasil diperbarui!');
}



    
    public function create()
    {
        // Menampilkan form untuk membuat peminjaman baru
        $member = Member::all();
        $bukus = Buku::where('stok', '>', 0)->get();
        return view('tambah.tambahmemberpeminjaman', compact('bukus', 'member'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'member_id' => 'required|exists:member,id_member',
            'tanggal_peminjaman' => 'required|date',
        ]);
    
        // Mendapatkan buku yang dipinjam
        $buku = Buku::findOrFail($request->buku_id);
    
        // Mengurangi stok buku
        if ($buku->stok > 0) {
            $buku->stok -= 1;
            $buku->save();
        } else {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }
    
        // Menyimpan data peminjaman baru
        $data = $request->all();
        $data['status'] = 'Dalam Peminjaman'; // Status peminjaman baru
    
        // Menyimpan data peminjaman
        PeminjamanPengembalian::create($data);
    
        return redirect()->route('halaman.peminjamanmember')->with('success', 'Data berhasil ditambahkan!');
    }
    

    public function destroy($id)
    {
        // Menghapus data peminjaman
        $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
        $peminjamanPengembalian->delete();

        return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil dihapus!');
    }
    public function indexPengembalianmember()
    {
        return view('halaman.pengembalianmember');
    }
    public function tablePengembalianMember(Request $request)
    {
        if ($request->ajax()) {
            $userName = $request->get('user_name'); // Get user name from request
    
            $peminjamans = PeminjamanPengembalian::where('status', 'Telah Dikembalikan')
                ->whereHas('member', function ($query) use ($userName) {
                    $query->where('nama', $userName);
                })
                ->with(['buku', 'member'])
                ->get();
                
            return DataTables::of($peminjamans)
                ->addIndexColumn()
                ->addColumn('judul_buku', function ($row) {
                    return $row->buku ? $row->buku->judul : 'N/A';
                })
                ->addColumn('nama_member', function ($row) {
                    return $row->member ? $row->member->nama : 'N/A';
                })
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex align-items-center">
                            <form action="/pengembalian/' . $row->id . '/detail" method="GET" class="mr-1">
                                <button type="submit" class="btn btn-secondary btn-xs"><i class="bi bi-info-circle"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['opsi'])
                ->make(true);
            }
        }
        public function showDetailPengembalian($id)
    {
        // Mendapatkan data peminjaman berdasarkan ID
        $peminjaman = PeminjamanPengembalian::with(['buku', 'member'])->findOrFail($id);
    
        // Menampilkan tampilan detail dengan data peminjaman
        return view('halaman.detailpengembalianmember', compact('peminjaman'));
    }

}