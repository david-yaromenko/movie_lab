<?php

namespace App\Factories;

use App\DTO\Admin\MovieDTO;
use App\Http\Requests\Admin\MovieRequest;

class MovieDTOFactory
{

    public static function fromRequest(MovieRequest $request): MovieDTO
    {

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        $screenshotPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $path = $screenshot->store('screenshots', 'public');
                $screenshotPaths[] = $path;
            }
        }

        return new MovieDTO(
            is_visible: $request->boolean('is_visible', true),
            title: $request->input('title', []),
            tagsIds: $request->input('tags', []),
            personsIds: $request->input('persons', []),
            roles: $request->input('roles', []),
            description: $request->input('description'),
            poster: $posterPath,
            screenshots: $screenshotPaths,
            trailer_id_youtube: $request->input('trailer_id_youtube'),
            year: $request->input('year'),
            watch_start_date: $request->input('watch_start_date'),
            watch_end_date: $request->input('watch_end_date'),
        );
    }
}
