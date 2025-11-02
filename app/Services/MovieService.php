<?php

namespace App\Services;

use App\DTO\Admin\MovieDTO;
use App\Interfaces\MovieInterface;
use App\Models\Movie;

class MovieService
{
    public function __construct(protected MovieInterface $movieInterface) {}

    public function createMovie(MovieDTO $movieDTO)
    {
        $movie = $this->movieInterface->create($movieDTO);
        return $movie;
    }

    public function update(MovieDTO $movieDTO, Movie $movie)
    {

        return $this->movieInterface->update($movieDTO, $movie);
    }

    public function getAllMovies()
    {
        $movies = $this->movieInterface->getAllMovies();
        return $movies;
    }

    public function getAllMoviesForHome()
    {
        $movies = $this->movieInterface->getAllMoviesForHome();

        return $movies;
    }

    public function delete(Movie $movie)
    {

        return $this->movieInterface->delete($movie);
    }
}
