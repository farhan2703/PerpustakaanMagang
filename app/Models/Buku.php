<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = [
        'id_buku',  
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'status_ketersediaan',
        'stok',
        'kategori',     
    ];
    protected $primaryKey = 'id_buku';

    public function scopeAvailable($query)
    {
        return $query->where('stok', '>', 0);
    }

    public static function countAvailableBooks()
    {
        return self::available()->count();
    }
}