<?php


namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
            $kategoribuku = KategoriBuku::select(['id_kategori', 'nama_kategori', 'deskripsi_kategori', 'created_at','updated_at'])->get();

            return DataTables::of($kategoribuku)
                ->addIndexColumn() // Menambahkan indeks otomatis
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex align-items-center">
                            <form action="/kategoribuku/' . $row->id_kategori . '/edit_kategoribuku" method="GET" class="me-2">
                                <button type="submit" class="btn btn-warning btn-xs"><i class="bi bi-pencil-square text-white"></i></button>
                            </form>
                            <form action="/kategoribuku/' . $row->id_kategori . '" method="GET" class="me-2">
                                <button type="submit" class="btn btn-secondary btn-xs"><i class="bi bi-info-circle"></i></button>
                            </form>
                            
                            <form action="/kategoribuku/' . $row->id_kategori . '/destroy" method="POST">
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
        return view('tambah.tambahkategoribuku'); // Pastikan ada view tambahbuku.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi_kategori' => 'required|string|max:255',
        ]);

        KategoriBuku::create([
            'nama_kategori' => $request->input('nama_kategori'),
            'deskripsi_kategori' => $request->input('deskripsi_kategori'),
        ]);

        return redirect()->route('halaman.kategoribuku')->with('success', 'Buku berhasil ditambahkan!');
    }

        // Menampilkan form update kategori
        public function edit($id_kategori)
        {
            $kategori = KategoriBuku::findOrFail($id_kategori);
            return view('edit.editkategoribuku', compact('kategori'));
        }
    
        // Menyimpan perubahan kategori
        public function update(Request $request, $id_kategori)
        {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'deskripsi_kategori' => 'required|string',
            ]);
    
            $kategori = KategoriBuku::findOrFail($id_kategori);
            $kategori->update([
                'nama_kategori' => $request->input('nama_kategori'),
                'deskripsi_kategori' => $request->input('deskripsi_kategori'),
            ]);
    
            return redirect()->route('halaman.kategoribuku')->with('success', 'Kategori buku berhasil diperbarui!');
        }

    public function detail($id)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id); // Mengambil detail kategori buku berdasarkan id
        return view('halaman.detail_kategoribuku', compact('kategoriBuku')); // Mengirim data kategori buku ke view
    }
    public function forcedelete($id)
    {
        $kategoribuku = KategoriBuku::find($id);

        if (!$kategoribuku) {
            return Redirect::route('halaman.kategoribuku')->with('error', 'Kategori Buku tidak ditemukan.');
        }

        $kategoribuku->delete();

        return Redirect::route('halaman.kategoribuku')->with('success', 'Kategori Buku berhasil dihapus.');
    }
}