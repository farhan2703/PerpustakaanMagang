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
                        <div class="d-flex align-items-center">
                            <form action="/pengembalian/' . $row->id . '/edit" method="GET" class="mr-1">
                                <button type="submit" class="btn btn-warning btn-xs"><i class="bi bi-pencil-square"></i></button>
                            </form>
                            <form action="/pengembalian/' . $row->id . '/delete" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i></button>
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
        // Menampilkan form untuk membuat peminjaman baru
        $bukus = Buku::all();
        $member = Member::all();
        return view('tambah.tambahpeminjaman', compact('bukus', 'member'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'member_id' => 'required|exists:member,id_member',
            'tanggal_peminjaman' => 'required|date',
        ]);

        // Menyimpan data peminjaman baru
        $data = $request->all();
        $data['status'] = 'Dalam Peminjaman'; // Status peminjaman baru

        PeminjamanPengembalian::create($data);

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

    // Mengupdate data peminjaman yang ada
    $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
    $data = $request->all();

    // Menentukan status berdasarkan tanggal pengembalian
    if (!empty($data['tanggal_pengembalian'])) {
        $data['status'] = 'Telah Dikembalikan';
    } else if ($peminjamanPengembalian->status === 'Telah Dikembalikan') {
        // Jika status sebelumnya adalah 'Telah Dikembalikan' dan tanggal pengembalian kosong, pertahankan status tersebut
        $data['status'] = 'Telah Dikembalikan';
    } else {
        // Jika tidak ada tanggal pengembalian, status tetap 'Dalam Peminjaman'
        $data['status'] = 'Dalam Peminjaman';
    }

    // Update data
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