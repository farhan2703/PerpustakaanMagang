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
        'created_at',
        'updated_at',
        'status',
        'id_buku',     
    ];
    protected $primaryKey = 'id_kategori';
}