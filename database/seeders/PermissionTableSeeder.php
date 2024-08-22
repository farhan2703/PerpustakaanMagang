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
            'Dashboard',
           'Kategori Buku',
           'Master Buku',
           'Buku',
           'Admin',
           'Member',
           'Peminjaman',
           'Peminjaman Member',
           'Pengembalian',
           'Pengembalian Member',
           'Role',
           'Data User',
        ];

        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
    }
}