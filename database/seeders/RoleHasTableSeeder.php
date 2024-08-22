<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleHasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);
        $pages = [
            'Dashboard',
           'Kategori Buku',
           'Master Buku',
           'Admin',
           'Member',
           'Peminjaman',
           'Pengembalian',
           'Role',
           'Data User',
        ];

        $admin->syncPermissions($pages);

        $member = Role::find(3);
        $pages = [
            'Dashboard',
            'Buku',
           'Peminjaman Member',
           'Pengembalian Member',

        ];

        $member->syncPermissions($pages);
    }
}