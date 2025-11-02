<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoviePersonRole extends Model
{
    protected $table = 'movie_person_role';
    protected $fillable = ['movie_id', 'person_id', 'role'];

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function person() {
        return $this->belongsTo(Person::class);
    }
}
