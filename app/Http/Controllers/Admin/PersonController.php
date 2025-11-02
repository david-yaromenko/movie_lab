<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PersonRequest;
use App\Models\Person;
use App\Services\PersonService;
use App\Services\TagService;

class PersonController extends Controller
{

    public function __construct(protected PersonService $personService, protected TagService $tagService) {}

    public function index()
    {

        $persons = $this->personService->getAllPersons();
        $tags = $this->tagService->getAllTagsForPerson();

        return view('admin.persons.index', compact('persons', 'tags'));
    }

    public function store(PersonRequest $request)
    {

        $this->personService->create($request->toDto());

        return redirect()->route('admin.persons.index');
    }

    public function edit(Person $person)
    {
        $tags = $this->tagService->getAllTagsForPerson();
        $person->load('types');

        return view('admin.persons.edit', compact('tags', 'person'));
    }

    public function update(PersonRequest $request, Person $person)
    {
        $personDTO = $request->toDto();

        $this->personService->update($personDTO, $person);

        return redirect()->route('admin.persons.index')->with('success', 'Person updated!');
    }

    public function destroy(Person $person)
    {

        $this->personService->delete($person);

        return redirect()->route('admin.persons.index')->with('success', 'Person deleted!');
    }
}
