<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Image;

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
            'is_admin' => 1,
            // 'avatar_url' => 'https://picsum.photos/id/1010/300/300.jpg',
            #Fkeys
            'language_id' => '2',
            ])->each(
                            function ($user, $id){
                                $user->images()->saveMany(Image::factory()->count(1)->create([
                                    'imageable_type' => 'App\Models\User',
                                    'imageable_id' => $id,
                                    'image_url' => 'https://picsum.photos/id/1010/300/300.jpg'
                                ]));
                                // $user->comments()->saveMany(Comment::factory()->count(10)->create());
                            }
                        );
        
        //basic user
        User::create([
            'name' => 'Basic User',
            'email' => 'basic@user.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$WfwoVT4cqvTOsOqr9uoqo.1zZc8lXcnEmwEn7O09ZuUTYw/YWchyK', // 12345678
            'remember_token' => 'toktoktokn',
            #added by b40deep
            'is_admin' => 0,
            // 'avatar_url' => 'https://picsum.photos/id/1003/300/300.jpg',
            #Fkeys
            'language_id' => '3',
            ])->each(
                        function ($user, $id){
                            $user->images()->saveMany(Image::factory()->count(1)->create([
                                'imageable_type' => 'App\Models\User',
                                'imageable_id' => $id,
                                'image_url' => 'https://picsum.photos/id/1003/300/300.jpg'
                            ]));
                            // $user->comments()->saveMany(Comment::factory()->count(10)->create());
                        }
                    );

        User::factory()
                ->count(3)
                ->create()
                ->each(
                    function ($user, $id){
                        $user->images()->saveMany(Image::factory()->count(1)->create([
                            'imageable_type' => 'App\Models\User',
                            'imageable_id' => $id,
                            'image_url' => "https://picsum.photos/id/".rand(0,1000)."/".(rand(0, 1)?"400":"600")."/".(rand(0, 1)?"400":"600").".jpg"
                        ]));
                        // $user->comments()->saveMany(Comment::factory()->count(10)->create());
                    }
                );
        
    }
}
