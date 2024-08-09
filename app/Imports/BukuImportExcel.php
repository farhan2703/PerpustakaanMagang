<?php
namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;

class BukuImportExcel implements ToModel
{
    public function model(array $row)
    {
        return new Buku([
            'judul' => $row[0],
            'penulis' => $row[1],
            'penerbit' => $row[2],
            'tahun_terbit' => $row[3],
            'status_ketersediaan' => $row[4],
            'stok' => $row[5],
            'kategori' => $row[6],
        ]);
    }
}