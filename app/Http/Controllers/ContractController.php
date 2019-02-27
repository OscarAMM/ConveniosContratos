<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Institute;
use App\User;
use App\Http\Requests\ContractRequest;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::All();
        return view('contracts.index', compact('contracts'));
    }

<<<<<<< HEAD
    public function create()
    {

        return view('contracts.create');
=======
    public function create(){
        $institutes = Institute::all(); 
        $users =User::All();
        return view('contracts.create',compact('institutes'),compact('users'));
>>>>>>> c6d959a83cca1f40b6b242e2d0b1b089852598c7
    }
    public function store(ContractRequest $request)
    {
        $contract = new Contract();
        $contract->name = $request->name;
        $contract->reception = $request->reception;
        $contract->objective = $request->objective;
        $contract->contractValidity = $request->contractValidity;
        $contract->scope = $request->scope;

        if (Contract::where('name', $contract->name)->exists()) {
            return back()->with('info', 'El contrato ya existe.');
        } else {
            $contract->save();
        }

        return redirect()->route('Contract.index')->with('info', 'El Contrato ha sido agregado');
    }
}
