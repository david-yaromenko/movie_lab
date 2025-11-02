<?php

namespace App\Repositories;

use App\DTO\Admin\TagDTO;
use App\Interfaces\TagInterface;
use App\Models\Tag;

class TagRepository implements TagInterface
{

    public function create(TagDTO $tagDTO)
    {

        $tag = Tag::create([
            'name' => $tagDTO->name,
            'slug' => $tagDTO->slug,
        ]);

        return $tag;
    }

    public function getAllTags()
    {

        $tags = Tag::withCount(['movies', 'persons'])->paginate(10);

        return $tags;
    }

    public function getAllTagsForPerson()
    {

        $tags = Tag::all();

        return $tags;
    }

    public function delete(Tag $tag)
    {
        return $tag->delete($tag);
    }
}
