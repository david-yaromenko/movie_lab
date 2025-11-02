<?php

namespace App\Services;

use App\DTO\Admin\TagDTO;
use App\Interfaces\TagInterface;
use App\Models\Tag;

class TagService
{

    public function __construct(protected TagInterface $tagInterface) {}

    public function create(TagDTO $tagDTO)
    {

        return $this->tagInterface->create($tagDTO);
    }

    public function getAllTags()
    {
        return $this->tagInterface->getAllTags();
    }

    public function getAllTagsForPerson()
    {
        return $this->tagInterface->getAllTagsForPerson();
    }

    public function delete(Tag $tag)
    {

        return $this->tagInterface->delete($tag);
    }
}
