<?php


namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategoriBuku = KategoriBuku::paginate(10); // Mengambil data dengan pagination
        return view('halaman.kategoribuku', compact('kategoriBuku')); // Mengirim data kategori buku ke view
    }

    public function store(Request $request)
    {
        // Tambahkan logika untuk menyimpan data kategori buku
    }

    public function detail($id)
    {
        $kategoriBuku = KategoriBuku::findOrFail($id); // Mengambil detail kategori buku berdasarkan id
        return view('halaman.detail_kategoribuku', compact('kategoriBuku')); // Mengirim data kategori buku ke view
    }
}