<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanPengembalian;
use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-info-circle"></i></button>
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
        $peminjaman = PeminjamanPengembalian::with(['buku', 'member'])->findOrFail($id);
        return view('halaman.detailpeminjamanmember', compact('peminjaman'));
    }
    
    public function edit($id)
    {
        $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
        $bukus = Buku::all();
        $member = Member::all();
        return view('edit.editpeminjamanmember', compact('peminjamanPengembalian', 'bukus', 'member'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'buku_id' => 'required|exists:buku,id_buku',
                'member_id' => 'required|exists:member,id_member',
                'tanggal_peminjaman' => 'required|date',
                'tanggal_pengembalian' => 'nullable|date',
                'status' => 'required|in:Dalam Peminjaman,Telah Dikembalikan',
            ]);

            $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);

            $member = Member::find($request->input('member_id'));
            if (!$member) {
                return redirect()->route('peminjamanmember.edit', $id)
                                 ->withInput()
                                 ->with('error', 'Member tidak ditemukan!');
            }

            $data = $request->all();
            $statusBaru = $data['status'];

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

            $data['member_id'] = $member->id_member;

            if ($statusBaru === 'Telah Dikembalikan' && $peminjamanPengembalian->status !== 'Telah Dikembalikan') {
                $buku = Buku::find($peminjamanPengembalian->buku_id);
                if ($buku) {
                    $buku->stok += 1;
                    $buku->save();
                }
            }

            $data['status'] = $statusBaru;
            $peminjamanPengembalian->update($data);

            DB::commit();
            return redirect()->route('halaman.peminjamanmember')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    public function create()
    {
        $member = Member::all();
        $bukus = Buku::where('stok', '>', 0)->get();
        return view('tambah.tambahmemberpeminjaman', compact('bukus', 'member'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'buku_id' => 'required|exists:buku,id_buku',
                'member_id' => 'required|exists:member,id_member',
            ]);

            $buku = Buku::findOrFail($request->buku_id);

            if ($buku->stok > 0) {
                $buku->stok -= 1;
                $buku->save();
            } else {
                return redirect()->back()->with('error', 'Stok buku habis!');
            }

            $data = $request->all();
            $data['status'] = 'Dalam Peminjaman';

            PeminjamanPengembalian::create($data);

            DB::commit();
            return redirect()->route('halaman.peminjamanmember')->with('success', 'Anda berhasil meminjam buku!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $peminjamanPengembalian = PeminjamanPengembalian::findOrFail($id);
            $peminjamanPengembalian->delete();

            DB::commit();
            return redirect()->route('halaman.peminjaman')->with('success', 'Data anda berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Destroy Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
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
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-info-circle"></i></button>
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
        $peminjaman = PeminjamanPengembalian::with(['buku', 'member'])->findOrFail($id);
        return view('halaman.detailpengembalianmember', compact('peminjaman'));
    }

    public function kembalikanBukuMember($id)
    {
        DB::beginTransaction();
        try {
            $peminjaman = PeminjamanPengembalian::findOrFail($id);
            $peminjaman->status = 'Telah Dikembalikan';
            $peminjaman->save();

            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->stok += 1;
                $buku->save();
            }

            DB::commit();
            return redirect()->route('halaman.peminjamanmember')->with('success', 'Buku telah berhasil dikembalikan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Kembalikan Buku Error: ' . $e->getMessage());
            return redirect()->route('halaman.peminjamanmember')->with('error', 'Terjadi kesalahan saat mengembalikan buku.');
        }
    }
}