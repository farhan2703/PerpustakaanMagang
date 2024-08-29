<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class KategoriBukuController extends Controller
{
    public function dashboard()
    {
        return view('member.dashboard');
    }

    public function kategoribuku(Request $request)
    {
        return view('halaman.kategoribuku');
    }

    public function tableKategori(Request $request)
    {
        if ($request->ajax()) {
            $kategoribuku = KategoriBuku::select(['id_kategori', 'nama_kategori', 'deskripsi_kategori', 'created_at', 'updated_at'])->get();

            return DataTables::of($kategoribuku)
                ->addIndexColumn()
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex align-items-center">
                            <form action="/kategoribuku/' . $row->id_kategori . '/edit_kategoribuku" method="GET" class="me-1">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square text-white"></i></button>
                            </form>
                            <form action="/kategoribuku/' . $row->id_kategori . '" method="GET" class="me-1">
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-info-circle"></i></button>
                            </form>
                            
                            <form action="/kategoribuku/' . $row->id_kategori . '/destroy" method="POST">
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
        return view('tambah.tambahkategoribuku');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'deskripsi_kategori' => 'required|string|max:255',
            ]);

            KategoriBuku::create([
                'nama_kategori' => $request->input('nama_kategori'),
                'deskripsi_kategori' => $request->input('deskripsi_kategori'),
            ]);

            DB::commit();

            return redirect()->route('halaman.kategoribuku')->with('success', 'Kategori Buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing category: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan kategori buku.']);
        }
    }

    public function edit($id_kategori)
    {
        $kategori = KategoriBuku::findOrFail($id_kategori);
        return view('edit.editkategoribuku', compact('kategori'));
    }

    public function update(Request $request, $id_kategori)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'deskripsi_kategori' => 'required|string',
            ]);

            $kategori = KategoriBuku::findOrFail($id_kategori);
            $kategori->update([
                'nama_kategori' => $request->input('nama_kategori'),
                'deskripsi_kategori' => $request->input('deskripsi_kategori'),
            ]);

            DB::commit();

            return redirect()->route('halaman.kategoribuku')->with('success', 'Kategori buku berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating category: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui kategori buku.']);
        }
    }

    public function detail($id)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id);
        return view('halaman.detail_kategoribuku', compact('kategoriBuku'));
    }

    public function forcedelete($id)
    {
        DB::beginTransaction();

        try {
            $kategoribuku = KategoriBuku::find($id);

            if (!$kategoribuku) {
                return Redirect::route('halaman.kategoribuku')->with('error', 'Kategori Buku tidak ditemukan.');
            }

            $kategoribuku->delete();

            DB::commit();

            return Redirect::route('halaman.kategoribuku')->with('success', 'Kategori Buku berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting category: ' . $e->getMessage());
            return Redirect::route('halaman.kategoribuku')->with('error', 'Terjadi kesalahan saat menghapus kategori buku.');
        }
    }
}