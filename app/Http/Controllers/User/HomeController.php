<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Services\MovieService;

class HomeController extends Controller
{
    public function __construct(protected MovieService $movieService) {}

    public function index()
    {
        $movies = $this->movieService->getAllMoviesForHome();

        return view('home.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        if (!$movie->is_visible) {
            abort(404);
        }

        return view('home.show', compact('movie'));
    }
}
