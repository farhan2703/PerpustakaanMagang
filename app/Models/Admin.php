<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    protected $table = 'admin'; // Nama tabel di database

    protected $fillable = [
        'nama_admin',
        'email',
        'password',
        'alamat',
        'no_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    public $timestamps = true; // Jika model menggunakan timestamps

    protected $primaryKey = 'id_admin'; // Custom primary key

    protected $hidden = [
        'password', // Menyembunyikan password
    ];

    // Mengambil password untuk otentikasi
    public function getAuthPassword()
    {
        return $this->password;
    }
}