<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::updateOrCreate([
            'id' => 1,
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        Role::updateOrCreate([
            'id' => 3,
            'name' => 'Member',
            'guard_name' => 'web'
        ]);
    }
}
