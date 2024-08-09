<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Member extends Authenticatable
{
    use Notifiable, HasRoles;

    // Nama tabel di database
    protected $table = 'members';

    // Menentukan kolom primer jika bukan id
    protected $primaryKey = 'id_member'; // Sesuaikan dengan nama kolom primer di tabel Anda

    // Menentukan apakah kolom primer auto-incrementing
    public $incrementing = false; // Ubah ke true jika menggunakan auto-increment

    // Jenis kolom primer
    protected $keyType = 'string'; // Ubah ke 'int' jika menggunakan integer sebagai kolom primer

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_member', // Pastikan id_member termasuk dalam fillable
        'nama',
        'no_telepon',
        'email',
        'password',
    ];

    // Menentukan apakah tabel menggunakan timestamps
    public $timestamps = true; // Atur ke false jika tabel tidak menggunakan created_at dan updated_at

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
    ];

    // Mengambil password untuk otentikasi
    public function getAuthPassword()
    {
        return $this->password;
    }
}