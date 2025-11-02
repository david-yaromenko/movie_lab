<?php 

namespace App\Interfaces;

use App\DTO\Admin\MovieDTO;
use App\Models\Movie;

interface MovieInterface{

    public function create(MovieDTO $movieDTO);
    public function update(MovieDTO $movieDTO, Movie $movie);
    public function delete(Movie $movie);
    public function getAllMovies();
    public function getAllMoviesForHome();

}