<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Http\Requests\ContractRequest;
use App\Institute;
use App\User;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::All();
        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        $institutes = Institute::all();
        $users = User::all();
        return view('contracts.create', compact('institutes'), compact('users'));
    }
    public function store(ContractRequest $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = time().$file->getClientOriginalName();
            $file->move(public_path().'/storage/',$fileName);
            
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
        return $request;
        //return redirect()->route('Contract.index')->with('info', 'El Contrato ha sido agregado');
    }
   
}
