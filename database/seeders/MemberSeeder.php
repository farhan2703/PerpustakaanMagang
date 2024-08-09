<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run()
    {
        DB::table('members')->insert([
            'nama' => 'Gilang Nugraha',
            'no_telepon' => '0859595593598',
            'email' => 'gilang32nugraha@gmail.com',
            'password' => Hash::make('123123123'),
            
        ]);
    }
}