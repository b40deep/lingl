<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Tag;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
                ->count(25)
                ->create()
                ->each(
                    function ($post, $id){
                        $post->images()->saveMany(Image::factory()->count(1)->create([
                            'imageable_type' => 'App\Models\Post',
                            'imageable_id' => $id,
                            'image_url' => (rand(0, 1)?"https://picsum.photos/id/".rand(0,1000)."/".(rand(0, 1)?"400":"600")."/".(rand(0, 1)?"400":"600").".jpg":"")
                        ]));

                        // $post->comments()->saveMany(Comment::factory()->count(10)->create());
                    }
                );
    }
}
