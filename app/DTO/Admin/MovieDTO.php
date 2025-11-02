<?php

namespace App\DTO\Admin;

class MovieDTO
{

    public function __construct(
        public readonly bool $is_visible = true,
        public readonly array $title = [],
        public readonly ?array $tagsIds = null,
        public readonly ?array $roles = null,
        public readonly ?array $personsIds = null,
        public readonly ?array $description = null,
        public readonly ?string $poster = null,
        public readonly ?array $screenshots = null,
        public readonly ?string $trailer_id_youtube = null,
        public readonly ?int $year = null,
        public readonly ?string $watch_start_date = null,
        public readonly ?string $watch_end_date = null,        
    ) {}
}
