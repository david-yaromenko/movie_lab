<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $fillable = ['type', 'name', 'photo'];

    protected $casts = [
        'name' => 'array',
    ];

    public function movie()
    {
        return $this->hasMany(MoviePersonRole::class);
    }

    public function types()
    {
        return $this->hasMany(PersonType::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'person_tag');
    }
}
