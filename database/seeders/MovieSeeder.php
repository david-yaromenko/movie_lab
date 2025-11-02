<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 10; $i++) {
            Movie::create([
                'is_visible' => true,
                'title' => [
                    'en' => "Interstellar #$i",
                    'uk' => "Інтерстеллар #$i",
                ],
                'description' => [
                    'en' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                    'uk' => 'Команда дослідників подорожує крізь кротову нору в космосі, щоб забезпечити виживання людства.',
                ],
                'poster' => 'posters/interstellar.jpg',
                'screenshots' => [
                    'screenshots/interstellar1.jpg',
                    'screenshots/interstellar2.jpg',
                    'screenshots/interstellar3.jpg',
                ],
                'trailer_id_youtube' => 'zSWdZVtXT7E',
                'year' => 2014,
                'watch_start_date' => '2014-11-07',
                'watch_end_date' => '2030-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
