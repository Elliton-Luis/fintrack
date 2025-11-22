<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name'=>'elliton',
            'email'=>'elliton@gmail.com',
            'password'=>bcrypt('elliton123'),
        ]);

        User::create([
            'name'=>'muto',
            'email'=>'muto@gmail.com',
            'password'=>bcrypt('muto123'),
        ]);
    }
}
