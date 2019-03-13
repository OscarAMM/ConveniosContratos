<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\FileAgreement;
use App\Http\Requests\AgreementRequest;
use App\Institute;
use App\Dependence;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $reception = $request->get('reception');
        $scope = $request->get('scope');
        $agreements = Agreement::orderBy('id', 'ASC')
            ->id($id)
            ->name($name)
            ->reception($reception)
            ->scope($scope)
            ->paginate();
        return view('agreements.index', compact('agreements'));
    }

    public function create()
    {
        $dependences = Dependence::all();
        $users = User::all();
        return view('agreements.create', compact('dependences','users'));
    }
    public function show($id)
    {
        $agreements = Agreement::find($id);
        $dependence_id = $agreements->dependence_id;
        $dependences = Dependence::find($dependence_id);
        $users = $agreements->getUser;
        $files=$agreements->getFiles;
        return view('agreements.show', compact('agreements', 'users', 'dependences','files'));
    }
    public function edit($id)
    {
        $agreements = Agreement::find($id);
        $user = $agreements->getUser;
        $users = User::all();
        //$institute_id = $agreements->institute_id;
        $dependence_id = $agreements->dependence_id;
        $dependences = Dependence::all();
        //buscar la dependencia y pasarlo a la vista (creo)
        return view('agreements.edit', compact('agreements', 'users', 'dependences', 'user'));
    }

    public function destroy($id)
    {
        $agreement = Agreement::find($id);
        $agreement->delete();

        return back()->with('info', "El convenio ha sido eliminado.");
    }
    public function update(AgreementRequest $request, $id)
    {
        //Convenio
        $agreement = Agreement::find($id);
        $agreement->name = $request->name;
        $agreement->reception = $request->reception;
        $agreement->objective = $request->objective;
        $agreement->agreementValidity = $request->agreementValidity;
        $agreement->scope = $request->scope;
        //$agreement->hide = $request->hide;
       // $agreement->institute_id = $request->institute_id;
        $agreement->dependence_id = $request->dependence_id;
        $users = $request->users;
        
            $agreement->update();
            $agreement->users()->detach();
            foreach ($users as $user) {
                // echo $user;
                $agreement->users()
                    ->attach(User::where('id', $user)->first());
            }
        
        return redirect()->route('Agreement.index')->with('info', 'El Convenio ha sido actualizado');

    }
    public function store(AgreementRequest $request)
    {

        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
        }else{
            return back()->with('info', 'No selecciono un archivo.');
        }
        //Archivo
        $file_Name = new FileAgreement();
        $file_Name->name = $file_path;
        if (FileAgreement::where('name', $file_Name->name)->exists()) {
            return back()->with('info', 'El archivo ya esta registrado');

        } else {
            $file_Name->save();
        }

        //Convenio
        $agreement = new Agreement();
        $agreement->name = $request->name;
        $agreement->reception = $request->reception;
        $agreement->objective = $request->objective;
        $agreement->agreementValidity = $request->agreementValidity;
        $agreement->scope = $request->scope;
        if($request->hide=="visible"){
            $agreement->hide = true;
        }else{
            $agreement->hide = false;
        }
        //$agreement->hide = $request->hide;
      //  $agreement->institute_id = $request->institute_id;
        $agreement->dependence_id = $request->dependence_id;
        $users = $request->users;
        if (Agreement::where('name', $agreement->name)->exists()) {
            return back()->with('info', 'El convenio ya existe.');
        } else {
            $agreement->save();
            foreach ($users as $user) {
                // echo $user;
                $agreement->users()
                    ->attach(User::where('id', $user)->first());
            }
            $agreement->files()
                ->attach(FileAgreement::where('id', $file_Name->id)->first());
        }
        return redirect()->route('Agreement.index')->with('info', 'El Convenio ha sido agregado');
    }
    public function showFile($id){
        $file = FileAgreement::find($id);
        return Storage::download('/filesAgreements/'.$file->name);
    }

}
