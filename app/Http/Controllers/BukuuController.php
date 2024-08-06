<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuuController extends Controller
{
    public function buku()
    {
        $Buku = Buku::paginate(10); // Mengambil data dengan pagination
        return view('halaman.buku', compact('Buku')); // Mengirim data buku ke view
    }

    public function store(Request $request)
    {
        // Tambahkan logika untuk menyimpan data buku
    }
    public function detail($id)
    {
        $buku = Buku::findOrFail($id); // Mengambil detail buku berdasarkan id
        return view('halaman.buku_detail', compact('buku')); // Mengirim data buku ke view
    }
}