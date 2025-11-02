<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Movie extends Model
{
    use HasFactory;

    public function personRoles()
    {
        return $this->hasMany(MoviePersonRole::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'movie_tag');
    }

    protected $fillable = [
        'is_visible',
        'title',
        'description',
        'poster',
        'screenshots',
        'trailer_id_youtube',
        'year',
        'watch_start_date',
        'watch_end_date'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'title' => 'array',
        'description' => 'array',
        'screenshots' => 'array',
        'watch_start_date' => 'date:Y-m-d',
        'watch_end_date' => 'date:Y-m-d',
    ];

    public function getTitleLocalizedAttribute(): string
    {
        $locale = LaravelLocalization::getCurrentLocale();
        return $this->title[$locale] ?? $this->title['en'] ?? '';
    }

    public function getDescriptionLocalizedAttribute(): string
    {
        $locale = LaravelLocalization::getCurrentLocale();
        return $this->description[$locale] ?? $this->description['en'] ?? '';
    }

    public function getLocalizedTagsAttribute()
    {
        $locale = LaravelLocalization::getCurrentLocale();
        return $this->tags->map(function ($tag) use ($locale) {
            return $tag->name[$locale] ?? $tag->name['en'] ?? '';
        });
    }

    public function getShowTrailerAttribute(): bool
    {
        if (!$this->trailer_id_youtube || !$this->watch_start_date || !$this->watch_end_date) {
            return false;
        }

        return now()->between($this->watch_start_date, $this->watch_end_date);
    }

    public function personsByRole(string $role)
    {
        return $this->personRoles
            ->where('role', $role)
            ->pluck('person');
    }
}
