<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Like gallery number 5
        $userIds = range(1, 18);

        foreach ($userIds as $userId) {
            Like::create([
                'gallery_id' => 5,
                'user_id' => $userId,
            ]);
        }
        // Like gallery number 5

        // Like gallery number 4
        foreach ($userIds as $userId) {
            Like::create([
                'gallery_id' => 4,
                'user_id' => $userId,
            ]);
        }
        // Like gallery number 4
    }
}
