<?php

namespace App\Repositories;

use App\DTO\Admin\PersonDTO;
use App\Interfaces\PersonInterface;
use App\Models\Person;

class PersonRepository implements PersonInterface
{

    public function create(PersonDTO $personDTO)
    {

        $newPerson = Person::create([
            'name' => $personDTO->name,
            'photo' => $personDTO->photo
        ]);

        $newPerson->tags()->attach($personDTO->tagsIds);

        $newPerson->types()->createMany(
            collect($personDTO->types)->map(fn($role) => ['type' => $role])->toArray()
        );

        return $newPerson;
    }

    public function update(PersonDTO $personDTO, Person $person)
    {

        $photo = !empty($personDTO->photo) ? $personDTO->photo : $person->photo;

        $person->update([
            'name' => $personDTO->name,
            'photo' => $photo
        ]);

        $person->tags()->sync($personDTO->tagsIds ?? []);

        $person->types()->delete();

        $person->types()->createMany(
            collect($personDTO->types ?? [])
                ->map(fn($role) => ['type' => $role])
                ->toArray()
        );
    }

    public function getAllPersons()
    {

        return Person::with('tags', 'types')->paginate(5);
    }

    public function getAllPersonsWithTypes()
    {
        return Person::with('types')->get();
    }

    public function delete(Person $person)
    {

        return $person->delete($person);
    }
}
