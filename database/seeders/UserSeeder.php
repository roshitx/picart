<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'roshitx',
            'fullname' => 'Muhammad Aulia Rasyid',
            'email' => 'auliarasyidalzahrawi@gmail.com',
            'password' => Hash::make('rosyid07'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'spitfireroshit',
            'fullname' => 'Andreas Roshit',
            'email' => 'roshit@gmail.com',
            'password' => Hash::make('rosyid07'),
            'role' => 'user',
        ]);

        User::create([
            'username' => 'damnroshit',
            'fullname' => 'Montero Shit',
            'email' => 'roshit2@gmail.com',
            'password' => Hash::make('rosyid07'),
            'role' => 'user'
        ]);
    }
}
