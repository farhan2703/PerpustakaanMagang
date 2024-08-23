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
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;
use Yajra\DataTables\DataTables;

class BukuMemberController extends Controller
{
    
    public function dashboard()
    {
        return view('member.dashboard');
    }

    public function bukumember(Request $request)
    {
        return view('halaman.bukumember');
    }

    public function tableBukuMember(Request $request)
{
    if ($request->ajax()) {
        // Mengambil buku yang stoknya lebih dari 0
        $buku = Buku::select(['id_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'status_ketersediaan', 'stok', 'kategori'])
            ->where('stok', '>', 0) // Filter buku dengan stok lebih dari 0
            ->get();

        return DataTables::of($buku)
            ->addIndexColumn() // Menambahkan indeks otomatis
            ->addColumn('opsi', function ($row) {
                return '
                    <div class="d-flex align-items-center">
                        <form action="/bukumember/' . $row->id_buku . '" method="GET" class="mr-1">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-info-circle"></i></button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['opsi']) // Pastikan kolom ini dianggap sebagai HTML
            ->make(true);
    }
}


    public function detailmember($id)
    {
        $buku = Buku::findOrFail($id);
        return view('halaman.bukumember_detail', compact('buku'));
    }
}