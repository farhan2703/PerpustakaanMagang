<?php

namespace Database\Seeders;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        try {
            $member = Member::create([
                'nama' => 'Rizky Farhan',
                'no_telepon' => '0859595593598',
                'email' => 'rizky@gmail.com',
                'password' => Hash::make('123123123'),
            ]);
            $member->assignRole('Admin');
               
            $member = Member::create([
                'nama' => 'Gilang Nugraha',
                'no_telepon' => '0859595593598',
                'email' => 'gilang32nugraha@gmail.com',
                'password' => Hash::make('123123123'),
            ]);
            $member->assignRole('Member');
            $member = Member::create([
                'nama' => 'Andi Pratama',
                'no_telepon' => '0859595593599',
                'email' => 'adminmember@gmail.com',
                'password' => Hash::make('123123123'),
            ]);
            // Assign multiple roles
            $member->assignRole(['Admin', 'Member']);
            DB::commit();
        } catch (\Throwable $th) {
           DB::rollback();
           echo $th->getMessage();
        }




    }
}