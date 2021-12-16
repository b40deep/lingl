<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\User;
use App\Models\Tag;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Language::factory()
        //         ->count(5)
        //         ->create();

        //Languages
        // Language::create([
        //                     'name' => array_rand( ['English', 'Malay', 'Swahili'] , 1 ),
        //                     'origin' => array_rand( ['Europe', 'Asia', 'Africa'] , 1 ),
        //                 ]);
        Language::create([
                            'name' => 'English',
                            'origin' => 'Europe',
                        ]);
        Language::create([
                            'name' => 'Malay',
                            'origin' => 'Asia',
                        ]);
        Language::create([
                            'name' => 'Swahili',
                            'origin' => 'Africa',
                        ]);
        Tag::create([
                        'name' => 'English'
                    ]);
        Tag::create([
                        'name' => 'Malay'
                    ]);
        Tag::create([
                        'name' => 'Swahili'
                    ]);
    }
}
