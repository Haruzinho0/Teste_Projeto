<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuarioSeed extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Rafael',
            'email' => 'teste@teste.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
