<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard',
           'kategori_buku',
           'master_buku',
           'buku',
           'admin',
           'member',
           'peminjaman',
           'peminjamanmember',
           'pengembalian',
           'pengembalianmember',
           'role',
           'datauser',
        ];

        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
