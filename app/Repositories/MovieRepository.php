<?php

namespace App\Repositories;

use App\DTO\Admin\MovieDTO;
use App\Events\MovieCreated;
use App\Interfaces\MovieInterface;
use App\Models\Movie;
use App\Models\MoviePersonRole;

class MovieRepository implements MovieInterface
{

    public function create(MovieDTO $movieDTO)
    {

        $movie = Movie::create([
            'is_visible' => $movieDTO->is_visible,
            'title' => $movieDTO->title,
            'description' => $movieDTO->description,
            'poster' => $movieDTO->poster,
            'screenshots' => $movieDTO->screenshots,
            'trailer_id_youtube' => $movieDTO->trailer_id_youtube,
            'year' => $movieDTO->year,
            'watch_start_date' => $movieDTO->watch_start_date,
            'watch_end_date' => $movieDTO->watch_end_date,
        ]);

        $movie->tags()->attach($movieDTO->tagsIds);

        foreach ($movieDTO->roles as $role => $personIds) {
            foreach ($personIds as $personId) {
                MoviePersonRole::create([
                    'movie_id' => $movie->id,
                    'person_id' => $personId,
                    'role' => $role,
                ]);
            }
        }

        $movieForTg = [
            'title' => $movieDTO->title,
            'poster' => $movieDTO->poster
        ];

        event(new MovieCreated($movieForTg));

        return $movie;
    }

    public function update(MovieDTO $movieDTO, Movie $movie)
    {

        $poster = !empty($movieDTO->poster) ? $movieDTO->poster : $movie->poster;
        $screenshots = !empty($movieDTO->screenshots) ? $movieDTO->screenshots : $movie->screenshots;


        $movie->update([
            'is_visible' => $movieDTO->is_visible,
            'title' => $movieDTO->title,
            'description' => $movieDTO->description,
            'poster' => $poster,
            'screenshots' => $screenshots,
            'trailer_id_youtube' => $movieDTO->trailer_id_youtube,
            'year' => $movieDTO->year,
            'watch_start_date' => $movieDTO->watch_start_date,
            'watch_end_date' => $movieDTO->watch_end_date,
        ]);

        $movie->tags()->sync($movieDTO->tagsIds ?? []);
        $movie->personRoles()->delete();

        foreach ($movieDTO->roles as $role => $personIds) {
            foreach ($personIds as $personId) {
                MoviePersonRole::create([
                    'movie_id' => $movie->id,
                    'person_id' => $personId,
                    'role' => $role,
                ]);
            }
        }

        return $movie;
    }

    public function getAllMovies()
    {
        $movies = Movie::paginate(5);

        return $movies;
    }

    public function getAllMoviesForHome()
    {
        $movies = Movie::with(['personRoles' => function ($query) {
            $query->where('role', 'director')->with('person');
        }])->orderBy('year', 'desc')
            ->paginate(8);

        return $movies;
    }

    public function delete(Movie $movie)
    {

        return $movie->delete($movie);
    }
}
