<?php

namespace App\Services;

use App\DTO\Admin\PersonDTO;
use App\Interfaces\PersonInterface;
use App\Models\Person;

class PersonService
{

    public function __construct(protected PersonInterface $personInterface) {}

    public function create(PersonDTO $personDTO)
    {

        return $this->personInterface->create($personDTO);
    }

    public function update(PersonDTO $personDTO, Person $person)
    {
        return $this->personInterface->update($personDTO, $person);
    }

    public function getAllPersons()
    {
        return $this->personInterface->getAllPersons();
    }

    public function getAllPersonsWithTypes()
    {
        return $this->personInterface->getAllPersons();
    }

    public function delete(Person $person)
    {

        return $this->personInterface->delete($person);
    }
}
