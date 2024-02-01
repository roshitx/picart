<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'roshitx',
            'fullname' => 'Muhammad Aulia Rasyid',
            'email' => 'auliarasyidalzahrawi@gmail.com',
            'password' => Hash::make('rosyid07'),
            'role' => 'admin',
        ]);

        $this->call(ImageSeeder::class);
    }
}
