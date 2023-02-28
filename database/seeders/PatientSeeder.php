<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'id' => floor(time()-999999999),
            'firstname' => 'CHRISPIN',
            'middlename' => 'BORCE',
            'lastname' => 'ZAMORANOS',
            'gender' => 'Male',
            'address' => 'Poblacion, Villaviciosa Abra',
            'birth_date' => Carbon::parse('1993-07-26'),
        ]);
    }
}