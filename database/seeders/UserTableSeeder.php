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
        //superuser
        User::create([
            'name' => 'Super User',
            'email' => 'super@user.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$WfwoVT4cqvTOsOqr9uoqo.1zZc8lXcnEmwEn7O09ZuUTYw/YWchyK', // 12345678
            'remember_token' => 'toktoktokn',
            #added by b40deep
            'role' => 'admin',
            'avatar_url' => 'https://i.picsum.photos/id/1010/300/300.jpg',
            #Fkeys
            'language_id' => '2',
        ]);

        User::factory()
                ->count(5)
                ->create()
                ->each(function ($user){
                    $user->posts()->saveMany(Post::factory()->count(5)->create());
                    $user->comments()->saveMany(Comment::factory()->count(10)->create());
                });
        
    }
}
