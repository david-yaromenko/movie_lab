<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected $casts = [
        'name' => 'array',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_tag');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_tag');
    }

    public function getUsageCountAttribute()
    {
        return ($this->movies_count ?? 0) + ($this->persons_count ?? 0);
    }
}
