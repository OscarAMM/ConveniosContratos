<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Dependence;
use App\FileAgreement;
use App\Http\Requests\AgreementRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;
use Session;
use App\Mail\SendEmail;
use Carbon\Carbon;



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
    public function indexPublic(Request $request)
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
        return view('public.index', compact('agreements'));
    }
    public function showPublic($id)
    {
        $agreements = Agreement::find($id);
        $dependence_id = $agreements->dependence_id;
        $dependences = Dependence::find($dependence_id);
        
        $files=$agreements->getFiles;
        $list=array($files);
        $cont=count($files);
        $file=FileAgreement::find(last($list)[$cont-1]->id);
        return view('public.show', compact('agreements', 'dependences', 'file'));
    }

    public function create()
    {
        $dependences = Dependence::all();
        $users = User::all();
        return view('agreements.create', compact('dependences', 'users'));
    }
    public function show($id)
    {
        $agreements = Agreement::find($id);
        $dependence_id = $agreements->dependence_id;
        $dependences = Dependence::find($dependence_id);
        $users = $agreements->getUser;
        $files = $agreements->getFiles;
        $fecha=$agreements->start_date;
        /*$dt= Carbon::now()->diffInDays($fecha);
        echo $dt."-";
        $dt2= Carbon::now()->diffForHumans($agreements->end_date);
        echo "Tu tiempo disponible es de: ".$dt2." del periodo de revisión";*/
        /*$date= Carbon::now();
        echo $date->format('Y-m-d');
        echo $date->addWeekDays(4)->format('Y-m-d');
        $date2=$date->addWeekDays(4);
        echo $date->diffInDays($date2->copy());*/
        return view('agreements.show', compact('agreements', 'users', 'dependences', 'files'));
    }
    public function edit($id)
    {
        $agreements = Agreement::find($id);
        $user = $agreements->getUser;
        $users = User::all();
        $dependence_id = $agreements->dependence_id;
        $dependences = Dependence::all();
        //buscar la dependencia y pasarlo a la vista (creo)
        return view('agreements.edit', compact('agreements', 'users', 'dependences', 'user'));
    }

    public function destroy($id)
    {
        $agreement = Agreement::find($id);
        $agreement->delete();

        return back()->with('info', "El convenio '.$agreement->name.' ha sido eliminado.");
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
        $agreement->dependence_id = $request->dependence_id;
        $users = $request->users;
        if ($request->hide == "visible") {
            $agreement->hide = true;
        } else {
            $agreement->hide = false;
        }
        $agreement->update();
        $agreement->users()->detach();
        foreach ($users as $user) {
            $activeUser=User::where('id', $user)->first();
                if(!$agreement->hasUser($activeUser->email)){
                    $email = $activeUser->email;
                    $subject = "Asignación de convenios";
                    $message = "Se le ha asignado el convenio ". $request->name." para revisión";
                    Mail::to($email)->send(new SendEmail($subject, $message));
                }
            $agreement->users()
                ->attach(User::where('id', $user)->first());
        }
        return redirect()->route('Agreement.index')->with('info', 'El Convenio '.$agreement->name. ' ha sido actualizado');

    }
    public function store(AgreementRequest $request)
    {

        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
        } else {
            return back()->with('info', 'No seleccionó un archivo.');
        }
        //Archivo
        $file_Name = new FileAgreement();
        $file_Name->name = $file_path;
        
            $file_Name->save();
        

        //Convenio
        $agreement = new Agreement();
        $agreement->name = $request->name;
        $agreement->reception = $request->reception;
        $agreement->objective = $request->objective;
        $agreement->agreementValidity = $request->agreementValidity;
        $agreement->scope = $request->scope;
        $agreement->status="Revisión";
        $agreement->liable_user = $request->liable_user;
        $agreement->start_date =  Carbon::now();
        $agreement->end_date = Carbon::now()->addWeekDays(4);
        if ($request->hide == "visible") {
            $agreement->hide = true;
        } else {
            $agreement->hide = false;
        }
        
        $agreement->dependence_id = $request->dependence_id;
        $users = $request->users;
        if (Agreement::where('name', $agreement->name)->exists()) {
            return back()->with('info', 'El convenio '.$agreement->name.' ya existe.');
        } else {
            $agreement->save();
            foreach ($users as $user) {
                    $activeUser=User::where('id', $user)->first();
                    $agreement->users()
                    ->attach(User::where('id', $user)->first());
                    $email = $activeUser->email;
                    $subject = "Asignación de convenios";
                    $message = " Se le ha asignado el convenio ". $request->name.", cuenta con 5 días para su revisión, desde ".$agreement->start_date->format('d-m-y')." hasta ".$agreement->end_date->format('d-m-y');
                    Mail::to($email)->send(new SendEmail($subject, $message));
            }
            $agreement->files()
                ->attach(FileAgreement::where('id', $file_Name->id)->first());
            $agreement->users()
                    ->attach(User::where('id', $agreement->liable_user)->first());
        }
        return redirect()->route('Agreement.index')->with('info', 'El Convenio '.$agreement->name.' ha sido agregado');
    }
    public function showFile($id)
    {
        $file = FileAgreement::find($id);
        return Storage::download('/filesAgreements/' . $file->name);
    }
    

}
