<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dependence;
use App\Http\Requests\DependenceRequest;


class DependenceController extends Controller
{
    public function index(Request $request){
        $name  =$request->get('name');
        $acronym =$request->get('acronym');
        $country = $request->get('country');
        $id    =$request->get('id');

        $dependence = Dependence::orderBy('id','ASC')
        ->name($name)
        ->acronym($acronym)
        ->country($country)
        ->id($id)
        ->paginate();

      // $dependence = Dependence::orderBy('id','ASC')->paginate();
        return view('dependencies.index', compact('dependence'));
    }
    public function show($id){
        $dependence = Dependence::find($id);
        return view('dependencies.show', compact('dependence'));
    }
    public function edit($id){
        $dependence = Dependence::find($id);
        return view('dependencies.edit', compact('dependence'));
       }
       public function create(){
        return view('dependencies.create');
   }
   public function destroy($id){
    $dependence = Dependence::find($id);
    $dependence->delete();

    return back()->with('info','La dependencia ha sido eliminada');
}
public function store(DependenceRequest $request){
    $dependence = new Dependence;
    $dependence->name = $request->name;
    $dependence->acronym = $request->acronym;
    $dependence->country = $request->country;

    $dependence->save();
    return redirect()->route('Dependence.index')->with('info','La dependencia ha sido agregado');
   }
   public function update(DependenceRequest $request,$id){
    $dependence = Dependence::find($id);
    $dependence->name = $request->name;
    $dependence->acronym = $request->acronym;
    $dependence->country = $request->country;

    $dependence->save();
    return redirect()->route('Dependence.index')->with('info','La dependencia ha sido actualizado');
}
}
