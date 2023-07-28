<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Elar',
            'email' => 'elar@elar.com',
            'password' => Hash::make('elar'),
            'user' => 'elar-dev'
        ]);

        DB::table('users')->insert([
            'name' => 'Elar',
            'email' => 'elar1@elar.com',
            'password' => Hash::make('elar'),
            'user' => 'elar-dev1'
        ]);

        DB::table('users')->insert([
            'name' => 'Elar',
            'email' => 'elar2@elar.com',
            'password' => Hash::make('elar'),
            'user' => 'elar-dev2'
        ]);
    }
}
