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
            DB::commit();
        } catch (\Throwable $th) {
           DB::rollback();
           echo $th->getMessage();
        }




    }
}
