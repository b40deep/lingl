<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
                ->count(5)
                ->create()
                ->each(function ($user){
                    $user->posts()->saveMany(Post::factory()->count(5)->create());
                    $user->comments()->saveMany(Comment::factory()->count(10)->create());
                });
    }
}
