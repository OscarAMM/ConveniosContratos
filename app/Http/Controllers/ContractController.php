<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Http\Requests\ContractRequest;
use App\Institute;
use App\User;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        $institutes = Institute::all();
        $users = User::all();
        return view('contracts.create', compact('institutes'), compact('users'));
    }
    public function show($id)
    {
        $contracts = Contract::find($id);
        $institutes = Institute::find($id);
        $users = User::find($id);
        return view('contracts.show', compact('contracts', 'users', 'institutes'));
    }
    public function edit($id)
    {
        $contract = Contract::find($id);
        return view('contracts.edit', compact('contract'));
    }

    public function destroy($id)
    {
        $contract = Contract::find($id);
        $contract->delete();

        return back()->with('info', "El contrato ha sido eliminado.");
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
        }
        $contract = new Contract();
        $contract->name = $request->name;
        $contract->reception = $request->reception;
        $contract->objective = $request->objective;
        $contract->contractValidity = $request->contractValidity;
        $contract->scope = $request->scope;
        $contract->institute_id = $request->institute_id;
        $users = $request->users;
        foreach ($users as $user) {
            echo $user;
        }
        if (Contract::where('name', $contract->name)->exists()) {
            return back()->with('info', 'El contrato ya existe.');
        } else {
            $contract->save();
            foreach ($users as $user) {
                // echo $user;
                $contract->users()
                    ->attach(User::where('id', $user)->first());
            }
        }

        return redirect()->route('Contract.index')->with('info', 'El Contrato ha sido agregado');
    }

}
