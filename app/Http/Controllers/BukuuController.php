<?php

namespace App\Http\Controllers;

use App\Exports\ExportBuku;
use App\Exports\ExportTemplate;
use App\Imports\ImportBuku;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;
use Yajra\DataTables\DataTables;

class BukuuController extends Controller
{
    public function dashboard()
    {
        return view('member.dashboard');
    }

    public function buku(Request $request)
    {
        return view('halaman.buku');
    }

    public function tableBuku(Request $request)
    {
        if ($request->ajax()) {
            $buku = Buku::select(['id_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'status_ketersediaan', 'stok', 'kategori'])->get();

            return DataTables::of($buku)
                ->addIndexColumn()
                ->editColumn('status_ketersediaan', function ($row) {
                    if ($row->stok <= 0) {
                        return '<span style="color: red;">Tidak Tersedia</span>';
                    } else {
                        return '<span style="color: green;">Tersedia</span>';
                    }
                })
                ->addColumn('opsi', function ($row) {
                    return '
                        <div class="d-flex align-items-center">
                            <form action="/buku/' . $row->id_buku . '/edit_buku" method="GET" class="me-1">
                                <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square text-white"></i></button>
                            </form>
                            <form action="/buku/' . $row->id_buku . '" method="GET" class="me-1">
                                <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-info-circle"></i></button>
                            </form>
                            <form action="/buku/' . $row->id_buku . '/destroy" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['status_ketersediaan', 'opsi'])
                ->make(true);
        }
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('halaman.buku_detail', compact('buku'));
    }

    public function create()
    {
        $kategoris = KategoriBuku::all();
        return view('tambah.tambahbuku', compact('kategoris'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
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

            DB::commit();

            return redirect()->route('halaman.buku')->with('success', 'Buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing book: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan buku.']);
        }
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = KategoriBuku::all();
        return view('edit.editbuku', compact('buku', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
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

            DB::commit();

            return redirect()->route('halaman.buku')->with('success', 'Buku berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating book: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui buku.']);
        }
    }

    public function forcedelete($id)
    {
        DB::beginTransaction();

        try {
            $buku = Buku::find($id);

            if (!$buku) {
                return Redirect::route('halaman.buku')->with('error', 'Buku tidak ditemukan.');
            }

            $buku->delete();

            DB::commit();

            return Redirect::route('halaman.buku')->with('success', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting book: ' . $e->getMessage());
            return Redirect::route('halaman.buku')->with('error', 'Terjadi kesalahan saat menghapus buku.');
        }
    }

    public function export_excel()
    {
        return Excel::download(new ExportBuku, 'data_buku.xlsx');
    }

    public function export_template()
    {
        return Excel::download(new ExportTemplate, 'templateexcel.xlsx');
    }

    public function export_pdf()
    {
        $buku = Buku::get();
        $data = [
            'title' => 'Data List Buku',
            'date' => date('Y-m-d H:i:s'),
            'buku' => $buku
        ];
        $pdf = Pdf::loadView('halaman.generate-buku-pdf', $data);
        return $pdf->download('data-buku.pdf');
    }

    public function imporexceltbuku(Request $request)
    {
        $data = $request->file('file');
        $namaFile = $data->getClientOriginalName();
        $data->move('BukuData', $namaFile);

        try {
            Excel::import(new ImportBuku, public_path('BukuData/' . $namaFile));
            return redirect()->route('halaman.buku')->with('success', 'Buku berhasil diimpor.');
        } catch (\Exception $e) {
            Log::error('Error importing books: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengimpor buku.']);
        }
    }
}