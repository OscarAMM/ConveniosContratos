<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    //The index make a request to DB to get fields from person
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $personType = $request->get('personType');
        $country = $request->get('country');
        $email = $request->get('email');
        $people = Person::orderBy('id', 'ASC')
            ->id($id)
            ->name($name)
            ->personType($personType)
            ->country($country)
            ->email($email)
            ->paginate();
        return view('people.index', compact('people'));

    }
    //The show gets the id from the table and pass to the show view
    public function show($id)
    {
        $person = Person::find($id);
        return view('people.show', compact('person'));
    }
    public function create()
    {
        return view('people.create');
    }
    //The destroy function gets the id from the person in the table and delete it
    public function destroy($id)
    {
        $people = Person::find($id);
        $people->delete();
        return back()->with('info', 'La persona ' . $people->name . ' ha sido eliminada');
    }
    //The function gets the fields into the db and store the text on those fields
    public function store(PersonRequest $request)
    {
        $person = new Person();
        $person->name = $request->name;
        $person->personType = $request->personType;
        $person->country = $request->country;
        $person->email = $request->email;
        //The function checks if a person with the same name alredy exists
        if (Person::where('name', $person->name)->exists()) {
            return back()->with('info', 'La persona ' . $person->name . ' ya existe.');
        } else {
            $person->save();
        }

        return redirect()->route('Person.index')->with('info', 'La persona ' . $person->name . ' ha sido agregado(a)');
    }
    public function update(PersonRequest $request, $id)
    {
        $person = Person::find($id);
        $person->name = $request->name;
        $person->personType = $request->personType;
        $person->country = $request->country;
        $person->email = $request->email;

        $person->save();

        return redirect()->route('Person.index')->with('info', 'La persona ' . $person->name . ' ha sido actualizado');
    }
    public function edit($id)
    {
        $person = Person::find($id);
        return view('people.edit', compact('person'));
    }
}
