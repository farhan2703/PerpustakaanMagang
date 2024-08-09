<?php

namespace App\Http\Controllers;

        // Import Excel
use App\Exports\BukuExport;
use App\Imports\BukuImportExcel;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class BukuuController extends Controller
{
    public function buku()
    {
        $Buku = Buku::paginate(10); // Mengambil data dengan pagination
        return view('halaman.buku', compact('Buku')); // Mengirim data buku ke view
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id); // Mengambil detail buku berdasarkan id
        return view('halaman.buku_detail', compact('buku')); // Mengirim data buku ke view
    }

    public function create()
    {
        $kategoris = KategoriBuku::all(); // Gantilah 'Kategori' dengan model yang sesuai
        return view('tambah.tambahbuku', compact('kategoris')); // Pastikan ada view tambahbuku.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
        ]);
        $status_ketersediaan = $request->stok > 0 ? 'Tersedia' : 'Tidak tersedia';
        Buku::create([
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'status_ketersediaan' => $status_ketersediaan,
            'stok' => $request->input('stok'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('halaman.buku')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {$buku = Buku::findOrFail($id);
        $kategoris = KategoriBuku::all(); // Ambil semua kategori dari database
        return view('edit.editbuku', compact('buku', 'kategoris')); // Mengirim data buku ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
            'stok' => 'required|integer',
            'kategori' => 'required|string|max:255',
        ]);
        $status_ketersediaan = $request->stok > 0 ? 'Tersedia' : 'Tidak tersedia';


        $buku = Buku::findOrFail($id);
        $buku->update([
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'status_ketersediaan' => $status_ketersediaan,
            'stok' => $request->input('stok'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('halaman.buku')->with('success', 'Buku berhasil diperbarui!');
    }

    public function forcedelete($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return Redirect::route('halaman.buku')->with('error', 'Buku tidak ditemukan.');
        }

        $buku->delete();

        return Redirect::route('halaman.buku')->with('success', 'Buku berhasil dihapus.');
    }

        public function bukuimportexcel(Request $request)
        {
            Log::info('Import process started');
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv|max:2048',
            ]);

            $file = $request->file('file');
            $namafile = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('databuku'), $namafile);
            $filePath = public_path('databuku/' . $namafile);

            if (!file_exists($filePath)) {
                Log::error('File not found');
                return redirect()->back()->with('error', 'File tidak ditemukan.');
            }

            try {
                Log::info('Deleting existing data');
                Buku::query()->delete(); // Atau sesuai dengan kebutuhan Anda
                Excel::import(new BukuImportExcel, $filePath);
                unlink($filePath);
                Log::info('Import successful');
                return redirect('/buku')->with('success', 'Data berhasil ditambahkan.');
            } catch (\Exception $e) {
                Log::error('Import failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
            }
        }


    
}