<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Jane',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'=>'Bob',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'=>'Susan',
            'email' => 'susan@example.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'=>'Dummy 1',
            'email' => 'dummy1@example.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
        ]);
    }
}
