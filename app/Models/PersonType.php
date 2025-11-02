<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonType extends Model{

    protected $table = 'person_type';

    protected $fillable = ['person_id', 'type'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}