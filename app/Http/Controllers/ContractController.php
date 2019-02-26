<?php

namespace App\Http\Controllers;
use App\Contract;
use App\Http\Requests\ContractRequest;
class ContractController extends Controller
{
    public function index()
    {   
        $contracts=Contract::All();
        return view('contracts.index');
    }

    public function create(){
        
        return view('contracts.create');
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
