<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanPengembalian;
use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;

class PeminjamanPengembalianController extends Controller
{
    public function indexPeminjaman()
    {
        // Mengambil data peminjaman dengan status 'Dalam Peminjaman'
        $peminjamans = PeminjamanPengembalian::where('status', 'Dalam Peminjaman')->with('buku', 'member')->paginate(10);
        return view('halaman.peminjaman', compact('peminjamans'));
    }

    public function indexPengembalian()
    {
        // Mengambil data pengembalian dengan status 'Telah Dikembalikan'
        $pengembalians = PeminjamanPengembalian::where('status', 'Telah Dikembalikan')->with('buku', 'member')->paginate(10);
        return view('halaman.pengembalian', compact('pengembalians'));
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