<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'nama_admin' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('q'),
            'alamat' => 'Jember',
            'no_telepon' => '085939392919',
            'tanggal_lahir' => '1999-01-01',
            'jenis_kelamin' => 'Laki-laki'

        ]);
    }
}
