<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstrumentRequest;
use App\LegalInstrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class LegalInstrumentController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $instruments = LegalInstrument::orderBy('id', 'ASC')
        ->id($id)
        ->name($name)
        ->paginate();
        return view('instrument.index', compact('instruments'));
    }
    public function create()
    {
        return view('instrument.create');
    }
    public function store(InstrumentRequest $request)
    {
        $instrument = new LegalInstrument();
        $instrument->name = $request->name;
        if (LegalInstrument::where('name', 'LIKE', "%{$instrument->name}%")->exists()) {
            return back()->with('info', ' El instrumento jurídico ' . $instrument->name . ' ya se encuentra registrado(a)');
        } else {
            $instrument->save();
        }
        return redirect()->route('LegalInstrument.index')->with('Info', 'El instrumento jurídico '.$instrument->name. 'ha sido agregado(a) con éxito.');
    }
    public function storeModal(InstrumentRequest $request)
    {
        $instrument = new LegalInstrument();
        $instrument->name = $request->name;
        if (LegalInstrument::where('name', 'LIKE', "%{$instrument->name}%")->exists()) {
            return back()->with('info', ' El instrumento jurídico ' . $instrument->name . ' ya  se encuentra registrado(a)');
        } else {
            $instrument->save();
        }
        //return Redirect::back()->withInput(Input::all());
        return back()->with('info', 'El instrumento jurídico: '.$instrument->name. 'ha sido agregado(a) con éxito.');
    }

    public function update(InstrumentRequest $request, $id)
    {
        $instrument = LegalInstrument::find($id);
        $instrument->name = $request->name;
        $instrument->save();
        return redirect()->route('LegalInstrument.index')->with('info', 'El instrumento jurídico '.$instrument->name. ' ha sido actualizado');
    }
    public function destroy($id)
    {
        $instrument = LegalInstrument::find($id);
        $instrument->delete();
        return back()->with('info', 'El instrumento jurídico '.$instrument->name. ' ha sido eliminado');
    }
     public function edit($id){
         $instrument = LegalInstrument::find($id);
         return view('instrument.edit', compact('instrument'));
     }
}
