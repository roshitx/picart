<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder photo 5
        Comment::create([
            'user_id' => 1,
            'gallery_id' => 5,
            'content' => 'Very cool photo!'
        ]);

        Comment::create([
            'user_id' => 3,
            'gallery_id' => 5,
            'content' => 'Amazing!'
        ]);

        Comment::create([
            'user_id' => 2,
            'gallery_id' => 5,
            'content' => 'This photo is on another level.'
        ]);

        Comment::create([
            'user_id' => 4,
            'gallery_id' => 5,
            'content' => 'Can i used for my wallpaper?'
        ]);

        Comment::create([
            'user_id' => 11,
            'gallery_id' => 5,
            'content' => 'Keep your good work!!'
        ]);
        // End seeder photo 5

        // Seeder photo 4
        Comment::create([
            'user_id' => 7,
            'gallery_id' => 4,
            'content' => 'Good picture'
        ]);

        Comment::create([
            'user_id' => 9,
            'gallery_id' => 4,
            'content' => 'What gear do you use? please explain use'
        ]);

        Comment::create([
            'user_id' => 12,
            'gallery_id' => 4,
            'content' => 'Where is this? Look the astonishing view!!'
        ]);
        // End seeder photo 4
    }
}
