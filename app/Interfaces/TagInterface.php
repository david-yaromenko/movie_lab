<?php

namespace App\Interfaces;

use App\DTO\Admin\TagDTO;
use App\Models\Tag;

interface TagInterface{

    public function create(TagDTO $tagDTO);
    public function delete(Tag $tag);
    public function getAllTags();
    public function getAllTagsForPerson();

}