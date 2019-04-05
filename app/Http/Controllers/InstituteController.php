<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstituteRequest;
use App\Institute;
use App\Dependence;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $acronym = $request->get('acronym');
        $country = $request->get('country');
        $institutions = Institute::orderBy('id', 'ASC')
            ->id($id)
            ->name($name)
            ->acronym($acronym)
            ->country($country)
            ->paginate();

        return view('institutes.index', compact('institutions'));
    }

    public function show($id)
    {
        $institutions = Institute::find($id);
       $dependences =$institutions ->getDependence;
       
        return view('institutes.show', compact('institutions','dependences'));
    }

    public function destroy($id)
    {
        $institutions = Institute::find($id);
        $institutions->delete();

        return back()->with('info', 'La institucion '.$institutions->name. ' ha sido eliminada');
    }

    public function create()
    {
        return view('institutes.create');
    }

    public function store(InstituteRequest $request)
    {
        $institute = new Institute();
        $institute->name = $request->name;
        $institute->acronym = $request->acronym;
        $institute->country = $request->country;
        if (Institute::where('name', $institute->name)->exists()) {
            return back()->with('info', 'La institución '.$institute->name.' ya existe.');
        } else {
            $institute->save();
        }

        return redirect()->route('Institute.index')->with('info', 'El Instituto '.$institute->name.' ha sido agregado');
    }

    public function update(InstituteRequest $request, $id)
    {
        $institute = Institute::find($id);
        $institute->name = $request->name;
        $institute->acronym = $request->acronym;
        $institute->country = $request->country;

        $institute->save();

        return redirect()->route('Institute.index')->with('info', 'El Instituto '.$institute->name.' ha sido actualizado');
    }

    public function edit($id)
    {
        $institute = Institute::find($id);

        return view('institutes.edit', compact('institute'));
    }
}
