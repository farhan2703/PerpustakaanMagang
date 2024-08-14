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
            'dashboard',
           'kategori_buku',
           'master_buku',
           'member',
           'peminjaman',
           'pengembalian',
        ];

        $admin->syncPermissions($pages);

        $member = Role::find(3);
        $pages = [
            'dashboard',
           'master_buku',
           'peminjaman',
           'pengembalian',
        ];

        $member->syncPermissions($pages);
    }
}