<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTemplate implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return []; // Tidak ada data, hanya header
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Judul Buku',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Status',
            'Stok',
            'Kategori'
        ];
    }
}