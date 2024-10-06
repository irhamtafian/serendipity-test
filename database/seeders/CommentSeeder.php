<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create example comments
        Comment::create([
            'article_id' => 1,
            'parent_id' => null,
            'username' => 'Irham',
            'email' => 'irham@gmail.com',
            'comment' => 'This is a sample comment.',
            'status' => 'PUBLISH',
        ]);

    }
}