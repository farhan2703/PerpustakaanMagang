<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanPengembalian;
use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-info-circle"></i></button>
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
    {
        // Validasi data input
        $request->validate([
            'buku_id' => 'required|exists:buku,id_buku',
            'member_id' => 'required|exists:member,id_member',
        ]);

        DB::beginTransaction();
        try {
            // Ambil data buku berdasarkan buku_id
            $buku = Buku::findOrFail($request->input('buku_id'));

            // Cek apakah stok buku lebih dari 0
            if ($buku->stok <= 0) {
                return redirect()->back()->with('error', 'Stok buku telah habis!');
            }

            // Menyimpan data peminjaman baru
            $data = $request->all();
            $data['status'] = 'Dalam Peminjaman'; // Status peminjaman baru

            // Simpan data peminjaman
            PeminjamanPengembalian::create($data);

            // Kurangi stok buku
            $buku->stok -= 1;
            $buku->save();

            DB::commit();

            return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
            'tanggal_pengembalian' => 'nullable|date',
            'status' => 'required|in:Dalam Peminjaman,Telah Dikembalikan',
        ]);

        DB::beginTransaction();
        try {
            // Mengambil data peminjaman yang akan diupdate
            $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);

            // Ambil id_member berdasarkan input member_id
            $member = Member::find($request->input('member_id'));

            if (!$member) {
                return redirect()->route('peminjaman.edit', $id)
                                 ->withInput()
                                 ->with('error', 'Member tidak ditemukan!');
            }

            // Mengupdate data peminjaman yang ada
            $data = $request->all();

            // Menentukan status berdasarkan tanggal pengembalian
            $statusBaru = $data['status'];

            // Validasi status dan tanggal pengembalian
            if ($statusBaru === 'Dalam Peminjaman' && !empty($data['tanggal_pengembalian'])) {
                return redirect()->route('peminjaman.edit', $id)
                                 ->withInput()
                                 ->with('warning', 'Jika status adalah "Dalam Peminjaman", tanggal pengembalian tidak boleh diisi.');
            }

            if ($statusBaru === 'Telah Dikembalikan' && empty($data['tanggal_pengembalian'])) {
                return redirect()->route('peminjaman.edit', $id)
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

            DB::commit();

            return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.edit', $id)
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // Menghapus data peminjaman
            $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
            $peminjamanPengembalian->delete();

            DB::commit();

            return redirect()->route('halaman.peminjaman')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('halaman.peminjaman')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function kembalikanBuku($id)
    {
        DB::beginTransaction();
        try {
            $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
            
            // Update status peminjaman menjadi "Telah Dikembalikan"
            $peminjamanPengembalian->status = 'Telah Dikembalikan';
            $peminjamanPengembalian->save();

            // Tambahkan stok buku kembali
            $buku = Buku::findOrFail($peminjamanPengembalian->buku_id);
            $buku->stok += 1;
            $buku->save();

            DB::commit();

            return redirect()->route('halaman.peminjaman')->with('success', 'Buku berhasil dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('halaman.peminjaman')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}