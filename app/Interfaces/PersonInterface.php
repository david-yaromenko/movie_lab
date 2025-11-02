<?php

namespace App\Interfaces;

use App\DTO\Admin\PersonDTO;
use App\Models\Person;

interface PersonInterface
{
    public function create(PersonDTO $personDTO);
    public function update(PersonDTO $personDTO, Person $person);
    public function delete(Person $person);
    public function getAllPersonsWithTypes();
    public function getAllPersons();
}
