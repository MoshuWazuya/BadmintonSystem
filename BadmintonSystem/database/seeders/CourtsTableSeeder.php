<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courts')->insert([
            ['court_name' => 'Court A', 'court_type' => 'Badminton', 'location' => 'Hall 1', 'status' => 'active'],
            ['court_name' => 'Court B', 'court_type' => 'Badminton', 'location' => 'Hall 2', 'status' => 'active'],
            ['court_name' => 'Court C', 'court_type' => 'Badminton', 'location' => 'Hall 3', 'status' => 'inactive'],
        ]);
    }
}

