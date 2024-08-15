<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanPengembalian;
use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PeminjamanPengembalianController extends Controller
{
    public function indexPeminjaman()
    {
        return view('halaman.peminjaman');
    }

    public function tablePeminjaman(Request $request)
    {
        if ($request->ajax()) {
            $peminjamans = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')
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
                            <form action="/peminjaman/' . $row->id . '/edit" method="GET" class="mr-1">
                                <button type="submit" class="btn btn-warning btn-xs"><i class="bi bi-pencil-square"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['opsi'])
                ->make(true);
        }
    }
    public function indexPengembalian()
    {
        return view('halaman.pengembalian');
    }

    public function tablePengembalian(Request $request)
    {
        if ($request->ajax()) {
            $pengembalians = PeminjamanPengembalian::where('status', 'Telah Dikembalikan')
                ->with(['buku', 'member'])
                ->get();

            return DataTables::of($pengembalians)
                ->addIndexColumn()
                ->addColumn('judul_buku', function ($row) {
                    return $row->buku ? $row->buku->judul : 'N/A';
                })
                ->addColumn('nama_member', function ($row) {
                    return $row->member ? $row->member->nama : 'N/A';
                })
                ->addColumn('opsi', function ($row) {
                    return '
                    ';
                })
                ->rawColumns(['opsi'])
                ->make(true);
        }
    }
    public function create()
    {
        // Menampilkan form untuk membuat peminjaman baru
        $bukus = Buku::all();
        $member = Member::all();
        return view('tambah.tambahpeminjaman', compact('bukus', 'member'));
    }

    public function store(Request $request)
    { // Validasi data input
        $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'member_id' => 'required|exists:member,id_member',
            'tanggal_peminjaman' => 'required|date',
        ]);
    
        // Ambil data buku berdasarkan buku_id
        $buku = Buku::findOrFail($request->input('buku_id'));
    
        // Cek apakah stok buku lebih dari 0
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi!');
        }
    
        // Menyimpan data peminjaman baru
        $data = $request->all();
        $data['status'] = 'Dalam Peminjaman'; // Status peminjaman baru
    
        // Simpan data peminjaman
        PeminjamanPengembalian::create($data);
    
        // Kurangi stok buku
        $buku->stok -= 1;
        $buku->save();
    
        return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit peminjaman yang ada
        $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
        $bukus = Buku::all();
        $member = Member::all();
        return view('edit.editpeminjaman', compact('peminjamanPengembalian', 'bukus', 'member'));
    }

    public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        'buku_id' => 'required|exists:buku,id_buku',
        'member_id' => 'required|exists:member,id_member',
        'tanggal_peminjaman' => 'required|date',
        'tanggal_pengembalian' => 'nullable|date' // Validasi untuk tanggal pengembalian yang opsional
    ]);

    // Mengambil data peminjaman yang akan diupdate
    $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);

    // Ambil id_member berdasarkan input member_id
    $member = Member::find($request->input('member_id'));

    if (!$member) {
        return redirect()->back()->with('error', 'Member tidak ditemukan!');
    }

    // Mengupdate data peminjaman yang ada
    $data = $request->all();

    // Menentukan status berdasarkan tanggal pengembalian
    $statusBaru = !empty($data['tanggal_pengembalian']) ? 'Telah Dikembalikan' : 'Dalam Peminjaman';

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

    return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil diperbarui!');
}


    public function destroy($id)
    {
        // Menghapus data peminjaman
        $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
        $peminjamanPengembalian->delete();

        return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil dihapus!');
    }
}