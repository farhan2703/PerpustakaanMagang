<?php
namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportBuku implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Mengonversi tanggal dari angka serial Excel menggunakan Carbon
        $tanggalTerbit = $this->transformDate($row['tahun_terbit']);
        
        // Memastikan kategori ada dan tidak kosong
        $kategori = isset($row['kategori']) ? $row['kategori'] : 'Tidak Diketahui';

        return new Buku([
            'judul' => $row['judul_buku'],
            'penulis' => $row['penulis'],
            'penerbit' => $row['penerbit'],
            'tahun_terbit' => $tanggalTerbit,
            'status_ketersediaan' => $row['status'],
            'stok' => $row['stok'],
            'kategori' => $kategori,
        ]);
    }

    /**
     * Transformasi tanggal dari angka serial Excel ke format yang bisa digunakan oleh database.
     *
     * @param mixed $value
     * @return string|null
     */
    private function transformDate($value)
{
    if (is_numeric($value)) {
        try {
            // Mengonversi angka serial Excel ke objek DateTime
            $date = Date::excelToDateTimeObject($value);
            // Mengonversi objek DateTime ke format yang diinginkan
            return Carbon::instance($date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Menangani kesalahan konversi dan mengembalikan null jika gagal
            return null;
        }
    } else {
        // Jika nilai bukan angka, coba formatkan sebagai string tanggal
        try {
            $date = Carbon::createFromFormat('Y-m-d', $value);
            return $date->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}

}