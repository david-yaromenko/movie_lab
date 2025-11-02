<?php

namespace App\DTO\Admin;

class PersonDTO
{

        public function __construct(
        public readonly array $types,
        public readonly array $name,
        public readonly array $tagsIds,
        public readonly ?string $photo = null,
    ) {}
}
