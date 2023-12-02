<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('users')->insert(array(
            array(
                'id'            => 1,
                'nama'          => 'Danil',
                'username'      => 'Danil',
                'email'         => 'danil@gmail.com',
                'telepon'       => '082167539876',
                'password'      => Hash::make('1234'),
                'role'          => 1,
            ),
            // array(
            //     'id'            => 2,
            //     'name'          => 'Febryan',
            //     'email'         => 'febryan@gmail.com',
            //     'password'      => Hash::make('1234'),
            //     'telp'          => '082191170349',
            //     'alamat'        => 'Maros',
            //     'role'          => 0,
            // ),
        ));
    }
}
