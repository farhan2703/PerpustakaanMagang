<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $this->call(RoleTableSeeder::class);
            $this->call(PermissionTableSeeder::class);
            $this->call(RoleHasTableSeeder::class);
            // $this->call(MemberSeeder::class);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            echo $th->getMessage();
        }
    }
}
