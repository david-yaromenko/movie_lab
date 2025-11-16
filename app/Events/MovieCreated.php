<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MovieCreated
{
    use Dispatchable, SerializesModels;

    public $movie;

    public function __construct(array $movie)
    {
        $this->movie = $movie;
    }
}
