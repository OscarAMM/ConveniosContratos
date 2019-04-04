<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DateTime;
use App\Contract;
use App\File;
use App\Http\Requests\ContractRequest;
use App\Institute;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;
use Session;
use App\Mail\SendEmail;
use Carbon\Carbon;

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
        //Show functionality
        
        $contracts = Contract::find($id);
        $institute_id = $contracts->institute_id;
        $institute = Institute::find($institute_id);
        $users = $contracts->getUser;
        $files=$contracts->getFiles;
        
        return view('contracts.show', compact('contracts', 'users', 'institute','files'));
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
                $activeUser=User::where('id', $user)->first();
                if(!$contract->hasUser($activeUser->email)){
                    $email = $activeUser->email;
                    $subject = "Asignación de contratos";
                    $message = "Se le ha asignado el contrato ". $request->name." para revisión";
                    Mail::to($email)->send(new SendEmail($subject, $message));
                }
                $contract->users()
                    ->attach(User::where('id', $user)->first());
                
        }
        return redirect()->route('Contract.index')->with('info', 'El Contrato '.$contract->name. ' ha sido actualizado');
    }
    public function store(ContractRequest $request)
    {
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
            return back()->with('info', 'El archivo ya ha sido registrado.');

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
        $contract->status="Revisión";
        $contract->liable_user = $request->liable_user;
        $contract->start_date =  Carbon::now();
        $contract->end_date = Carbon::now()->addWeekDays(4);

        $users = $request->users;
        if (Contract::where('name', $contract->name)->exists()) {
            return back()->with('info', 'El contrato ya existe.');
        } else {
            $contract->save();
            foreach ($users as $user) {
                // echo $user;
                $activeUser=User::where('id', $user)->first();
                $contract->users()
                    ->attach(User::where('id', $user)->first());
                    $email = $activeUser->email;
                    $subject = "Asignación de contratos";
                    $message = "Se le ha asignado el contrato ". $request->name.", cuenta con 5 días para su revisión, desde ".$contract->start_date->format('d-m-y')." hasta ".$contract->end_date->format('d-m-y');

                    Mail::to($email)->send(new SendEmail($subject, $message));
            }
            $contract->files()
                ->attach(File::where('id', $file_Name->id)->first());
        }
        /*$date = date('Y-m-d');
        $ano = substr($date, -10, 4);
        $mes = substr($date, -5, 2);
        $dia = substr($date, -2, 2);
        echo $ano;
        echo $mes ;
        echo $dia+5;
        echo $date;*/
        return redirect()->route('Contract.index')->with('info', 'El Contrato ha sido agregado');
    }
    public function showFile($id){
        $file = File::find($id);
        $exists = Storage::disk('public')->exists('files/'.$file->name);
        echo "existe";
        return Storage::download('/files/'.$file->name);
    }
  
}