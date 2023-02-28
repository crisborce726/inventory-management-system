<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '20230001',
            'name' => 'Rowena May V. Cabudol',
            'position' => 'MIDWIFE II / SUPPLY OFFICER',
            'username' => 'cabudol_r',
            'password' => Hash::make('user'),
            'image' => 'female.jpg',
            'remember_token' => Str::random(10),
            'created_at'=> now(),
		    'updated_at'=> now()
        ]);
    }
}