<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Tag;
use App\Models\Person;
use App\Models\MoviePersonRole;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::all();

        $personsData = [
            [
                'name' => ['en' => 'Matthew McConaughey', 'uk' => 'Меттью Макконагі'],
                'photo' => 'persons/matthew.jpg',
                'types' => ['actor', 'director']
            ],
            [
                'name' => ['en' => 'Anne Hathaway', 'uk' => 'Енн Гетевей'],
                'photo' => 'persons/anne.jpg',
                'types' => ['actor']
            ],
            [
                'name' => ['en' => 'Christopher Nolan', 'uk' => 'Крістофер Нолан'],
                'photo' => 'persons/nolan.jpg',
                'types' => ['director', 'screenwriter', 'composer']
            ],
        ];

        $persons = collect($personsData)->map(function ($p) {
            $person = Person::create([
                'name' => $p['name'],
                'photo' => $p['photo'],
            ]);

            foreach ($p['types'] as $type) {
                $person->types()->create(['type' => $type]);
            }

            return $person;
        });

        for ($i = 1; $i <= 10; $i++) {

            $movie = Movie::create([
                'is_visible' => true,
                'title' => [
                    'en' => "Interstellar #$i",
                    'uk' => "Інтерстеллар #$i",
                ],
                'description' => [
                    'en' => 'A team of explorers travel through a wormhole...',
                    'uk' => 'Команда дослідників подорожує крізь кротову нору...',
                ],
                'poster' => "posters/interstellar.jpg",
                'screenshots' => [
                    'screenshots/interstellar1.jpg',
                    'screenshots/interstellar2.jpg',
                ],
                'trailer_id_youtube' => 'zSWdZVtXT7E',
                'year' => 2014,
                'watch_start_date' => '2014-11-07',
                'watch_end_date' => '2030-12-31',
            ]);

            $movie->tags()->attach(
                $tags->random(rand(3, 5))->pluck('id')
            );

            foreach ($persons as $person) {
                foreach ($person->types as $type) {
                    MoviePersonRole::create([
                        'movie_id' => $movie->id,
                        'person_id' => $person->id,
                        'role' => $type->type,
                    ]);
                }
            }
        }
    }
}
