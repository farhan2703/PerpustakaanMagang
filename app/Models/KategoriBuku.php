<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = [
        'id_kategori',  
        'nama_kategori',
        'deskripsi_kategori',
        'tanggal_dibuat',
        'tanggal_diperbarui',
        'status',
        'id_buku',     
    ];
    protected $primaryKey = 'id_kategori';
}