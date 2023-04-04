<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role_users')->insert([
            'users_id' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now(),
        ]);
        DB::table('role_users')->insert([
            'users_id' => 2,
            'role_id' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('role_users')->insert([
            'users_id' => 3,
            'role_id' => 3,
            'created_at' => Carbon::now(),
        ]);
    }
}
