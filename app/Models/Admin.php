<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $fillable = [
        'nama_admin',
        'username',
        'password',
        'alamat',
        'no_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'id_member',
        'id_buku',
    ];
    protected $primaryKey = 'id_admin';
    
    // Sembunyikan password dari array output (misalnya saat konversi ke JSON)
    protected $hidden = [
        'password',
    ];
}