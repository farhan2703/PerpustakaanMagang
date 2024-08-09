<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
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

        $cuy = Member::create([
            'nama' => 'Admin ihiy',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'no_telepon' => '085939392919',
        ]);

        $member = Member::where('nama',$cuy->nama)->first();

        $member->assignRole('Admin');
    }
}
