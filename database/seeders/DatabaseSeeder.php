<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this -> call(LanguageTableSeeder::class);
        $this -> call(UserTableSeeder::class);
        $this -> call(PostTableSeeder::class);
        $this -> call(CommentTableSeeder::class);
        $this -> call(AlertTableSeeder::class);

        // $lugi = new Language;
        // $lugi->name='Luganda';
        // $lugi->origin='Uganda';
        // $lugi->save();
    }
}
