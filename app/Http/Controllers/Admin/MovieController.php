<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MovieRequest;
use App\Models\Movie;
use App\Services\MovieService;
use App\Services\PersonService;
use App\Services\TagService;

class MovieController extends Controller
{
    public function __construct(protected MovieService $movieService, protected TagService $tagService, protected PersonService $personService) {}

    public function create()
    {
        $tags = $this->tagService->getAllTagsForPerson();
        $persons = $this->personService->getAllPersonsWithTypes();

        return view('admin.movies.create', compact('tags', 'persons'));
    }

    public function store(MovieRequest $request)
    {
        $this->movieService->createMovie($request->toDto());

        return redirect()->route('admin.movies.create')->with('success', 'Film created!');
    }

    public function edit(Movie $movie)
    {
        $tags = $this->tagService->getAllTagsForPerson();
        $persons = $this->personService->getAllPersonsWithTypes();

        return view('admin.movies.edit', compact('movie', 'tags', 'persons'));
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $movieDTO = $request->toDto();

        $this->movieService->update($movieDTO, $movie);

        return redirect()->route('admin.movies.index')->with('success', 'Film updated!');
    }

    public function destroy(Movie $movie)
    {

        $this->movieService->delete($movie);

        return redirect()->route('admin.movies.index')->with('success', 'Film deleted!');
    }

    public function getAllMovies()
    {

        $movies = $this->movieService->getAllMovies();

        return view('admin.movies.index', compact('movies'));
    }
}
