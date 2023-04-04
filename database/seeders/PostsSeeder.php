<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            'title'=>'Correct',
            'content' => 'As a Brazilian I agree',
            'picture' => 'https://preview.redd.it/6a1anf0fkcy31.png?auto=webp&s=ba4af472a168c86884f2ac2350ee066725bce301',
            'created_at' => '2022-11-29 18:37:57',
            'created_by' => 1,
        ]);
        DB::table('posts')->insert([
            'title'=>'Angry Canadians',
            'content' => 'Do they exist?',
            'picture' => 'https://img.buzzfeed.com/buzzfeed-static/static/2015-11/9/11/enhanced/webdr09/enhanced-31976-1447087603-5.jpg?downsize=900:*&output-format=auto&output-quality=auto',
            'created_at' => Carbon::now(),
            'created_by' => 2,
        ]);
    }
}
