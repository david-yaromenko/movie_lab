<?php

namespace App\DTO\Admin;

class TagDTO
{

    public function __construct(
        public readonly array $name = [],     
        public readonly ?string $slug = null
    ) {}
}
