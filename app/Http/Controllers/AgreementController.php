<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\FileAgreement;
use App\Http\Requests\AgreementRequest;
use App\LegalInstrument;
use App\Mail\SendEmail;
use App\Person;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;

class AgreementController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $splitName = explode(' - ', $request->get('people_id'));
        $people= $splitName[0];
        //$people = $request->get('people_id');
        $objective = $request->get('objective');
        if($request->get('id')||
        $request->get('name')||
        $request->get('legalInstrument')||
        $request->get('instrumentType')||
        $request->get('people_id')||
        $request->get('objective')
        ){
            $agreements = Agreement::orderBy('id', 'ASC')
            ->id($id)
            ->name($name)
            ->legalInstrument($legalInstrument)
            ->instrumentType($instrumentType)
            ->people_id($people)
            ->objective($objective)
            ->paginate();
        }else{
            $agreements = Agreement::where('id','0')->orderBy('id', 'ASC')->paginate();
        }
        
        

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
        $person_id = $agreements->people_id;
        $people = Person::find($person_id);
        $files = $agreements->getFiles;
        $list = array($files);
        $cont = count($files);
        $file = FileAgreement::find(last($list)[$cont - 1]->id);
        return view('public.show', compact('agreements', 'people', 'file'));
    }

    public function create()
    {
        $people = Person::all();
        $users = User::all();
        $instrument = LegalInstrument::all();
        return view('agreements.create', compact('people', 'users', 'instrument'));
    }
    public function show($id)
    {
        $agreements = Agreement::find($id);
        $person_id = $agreements->people_id;
        $person = Person::find($person_id);
        $users = $agreements->getUser;
        $files = $agreements->getFiles;
        $fecha = $agreements->start_date;

        return view('agreements.show', compact('agreements', 'users', 'person', 'files'));
    }
    public function edit($id)
    {
        $agreements = Agreement::find($id);
        $liableUser = User::find($agreements->liable_user);
        $users = User::all();
        $people = Person::find($agreements->people_id);
        //buscar la dependencia y pasarlo a la vista (creo)
        return view('agreements.edit', compact('agreements', 'users', 'people', 'liableUser'));
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
        $agreement->legalInstrument = $request->legalInstrument;
        $agreement->instrumentType = $request->instrumentType;
        $agreement->scope = $request->scope;
        if($request->end_date){
            $agreement->end_date=new Carbon($request->end_date);
        }else{
            $pre=new Carbon($request->reception);
            $final=$pre->addWeekDays(4);
            $agreement->end_date = $final;
        }
        $splitName2 = explode(' - ', $request->liable_user);
        $agreement->liable_user = $splitName2[0];
        $users = $request->users;
        /*  if ($request->hide == "visible") {
        $agreement->hide = true;
        } else {
        $agreement->hide = false;
        }*/

        $splitName = explode(' - ', $request->people_id);
        $agreement->people_id = $splitName[0];
        $agreement->update();
        $agreement->users()->detach();
        foreach ($users as $user) {
            $activeUser = User::where('id', $user)->first();
            if (!$agreement->hasUser($activeUser->email)) {
                $email = $activeUser->email;
                $subject = "Asignación de convenios";
                $message = "Se le ha asignado el convenio " . $request->name . " para revisión";
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
            $agreement->users()
                ->attach(User::where('id', $user)->first());
        }
        return redirect()->route('Agreement.index')->with('info', 'El Convenio ' . $agreement->name . ' ha sido actualizado');
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
        $agreement->legalInstrument = $request->legalInstrument;
        $agreement->instrumentType = $request->instrumentType;
        $agreement->scope = $request->scope;
        $agreement->status = "Revisión";
        $splitName2 = explode(' - ', $request->liable_user);

        $agreement->liable_user = $splitName2[0];
        //$agreement->start_date = Carbon::now();
        $agreement->start_date = new Carbon($request->reception);
        if($request->end_date){
            $agreement->end_date=new Carbon($request->end_date);
        }else{
            $pre=new Carbon($request->reception);
            $final=$pre->addWeekDays(4);
            $agreement->end_date = $final;
        }
        
        /*if ($request->hide == "visible") {
        $agreement->hide = true;
        } else {
        $agreement->hide = false;
        }*/
        $splitName = explode(' - ', $request->people_id);
        $agreement->people_id = $splitName[0];
        $users = $request->users;
        if (Agreement::where('name', $agreement->name)->exists()) {
            return back()->with('info', 'El convenio ' . $agreement->name . ' ya existe.');
        } else {
            $agreement->save();
            foreach ($users as $user) {
                $activeUser = User::where('id', $user)->first();
                $agreement->users()
                    ->attach(User::where('id', $user)->first());
                $email = $activeUser->email;
                $subject = "Asignación de convenios";
                $message = " Se le ha asignado el convenio " . $request->name . ", cuenta con 5 días para su revisión, desde " . $agreement->start_date->format('d-m-y') . " hasta " . $agreement->end_date->format('d-m-y');
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
            $agreement->files()
                ->attach(FileAgreement::where('id', $file_Name->id)->first());
            $agreement->users()
                ->attach(User::where('id', $agreement->liable_user)->first());
        }
        return redirect()->route('Agreement.index')->with('info', 'El Convenio ' . $agreement->name . ' ha sido agregado');
    }
    public function showFile($id)
    {
        $file = FileAgreement::find($id);
        return Storage::download('/filesAgreements/' . $file->name);
    }
    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('people')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
         <li class="dropdown-item">' . $row->id . ' - ' . $row->name . '</li>
         ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function fetchUsers(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query2');
            $data = DB::table('users')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
         <li class="dropdown-item">' . $row->id . ' - ' . $row->name . ' - ' . $row->email . '</li>
         ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function fetchInstruments(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('legal_instruments')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
         <li class="dropdown-item">' . $row->name . '</li>
         ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
