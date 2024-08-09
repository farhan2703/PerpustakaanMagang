<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanPengembalian extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_pengembalian';

    protected $fillable = [
        'buku_id',
        'member_id',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}