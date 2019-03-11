<?php

namespace App\Http\Controllers;

use App\Contract;
use App\File;
use App\Http\Requests\ContractRequest;
use App\Institute;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $reception = $request->get('reception');
        $scope = $request->get('scope');
        $contracts = Contract::orderBy('id', 'ASC')
            ->id($id)
            ->name($name)
            ->reception($reception)
            ->scope($scope)
            ->paginate();
        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        $institutes = Institute::all();
        $users = User::all();
        return view('contracts.create', compact('institutes','users'));
    }
    public function show($id)
    {
        $contracts = Contract::find($id);
        $institute_id = $contracts->institute_id;
        $institute = Institute::find($institute_id);
        $users = $contracts->getUser;
        return view('contracts.show', compact('contracts', 'users', 'institute'));
    }
    public function edit($id)
    {
        $contracts = Contract::find($id);
        $user = $contracts->getUser;
        $users = User::all();
        $institute_id = $contracts->institute_id;
        $institutes = Institute::all();
        return view('contracts.edit', compact('contracts', 'users', 'institutes', 'user'));
    }

    public function destroy($id)
    {
        $contract = Contract::find($id);
        $contract->delete();

        return back()->with('info', "El contrato ha sido eliminado.");
    }
    public function update(ContractRequest $request, $id)
    {
        /*$file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('files/' . $file_path, \File::get($file));
        }
        //Archivo
        $file_Name = new File();
        $file_Name->name = time().$file_path;
        if (File::where('name', $file_Name->name)->exists()) {
            return back()->with('info', 'eh morro, ya esta arriba');
        } else {
            $file_Name->save();
        }*/

        //Contrato
        $contract = Contract::find($id);
        $contract->name = $request->name;
        $contract->reception = $request->reception;
        $contract->objective = $request->objective;
        $contract->contractValidity = $request->contractValidity;
        $contract->scope = $request->scope;
        $contract->institute_id = $request->institute_id;
        $users = $request->users;
        
            $contract->update();
            $contract->users()->detach();
            foreach ($users as $user) {
                // echo $user;
                $contract->users()
                    ->attach(User::where('id', $user)->first());
            }
            //$contract->files()->detach();
            /*$contract->files()
                ->attach(File::where('id', $file_Name->id)->first());*/
        
        return redirect()->route('Contract.index')->with('info', 'El Contrato ha sido actualizado');

    }
    public function store(ContractRequest $request)
    {
        /* if ($request->hasFile('file')) {
        $path = Storage::disk('public')->put('files', $request->file('file'));
        // $contract->fill(['file' => asset($path)]) ->save();
        }*/
        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('files/' . $file_path, \File::get($file));
        }else{
            return back()->with('info', 'No selecciono un archivo.');
        }
        //Archivo
        $file_Name = new File();
        $file_Name->name = $file_path;
        if (File::where('name', $file_Name->name)->exists()) {
            return back()->with('info', 'eh morro, ya esta arriba');

        } else {
            $file_Name->save();
        }

        //Contrato
        $contract = new Contract();
        $contract->name = $request->name;
        $contract->reception = $request->reception;
        $contract->objective = $request->objective;
        $contract->contractValidity = $request->contractValidity;
        $contract->scope = $request->scope;
        $contract->institute_id = $request->institute_id;
        $users = $request->users;
        if (Contract::where('name', $contract->name)->exists()) {
            return back()->with('info', 'El contrato ya existe.');
        } else {
            $contract->save();
            foreach ($users as $user) {
                // echo $user;
                $contract->users()
                    ->attach(User::where('id', $user)->first());
            }
            $contract->files()
                ->attach(File::where('id', $file_Name->id)->first());
        }
        return redirect()->route('Contract.index')->with('info', 'El Contrato ha sido agregado');
    }


}