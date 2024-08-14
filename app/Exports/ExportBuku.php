<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBuku implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    
    {   
        $Buku = Buku::orderBy('judul', 'asc')->get();
        return view('tables.tablebuku',['Buku'=> $Buku]);
    }
}