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
        $countries = $request->get('countries');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $reception = $request->get('reception');
        $people = $request->get('people_id');
/*
if ($people) {
if (str_contains($people, ' - ')) {
$splitName = explode(' - ', $request->get('people_id'));
$agreements = Person::find($splitName[0])->agreements()
->where('name', 'LIKE', "%$name%")
->where('countries', 'LIKE', "%$countries%")
->where('legalInstrument', 'LIKE', "%$legalInstrument%")
->where('instrumentType', 'LIKE', "%$instrumentType%")
->where('objective', 'LIKE', "%$objective%")
->where('reception', 'LIKE', "%$reception%")
->orderBy('id', 'DESC')
->paginate();
} else {
$person = Person::where('name', 'LIKE', "%$people%")->first();
if (!empty($person)) {
$agreements = $person->agreements()
->where('name', 'LIKE', "%$name%")
->where('countries', 'LIKE', "%$countries%")
->where('legalInstrument', 'LIKE', "%$legalInstrument%")
->where('instrumentType', 'LIKE', "%$instrumentType%")
->where('objective', 'LIKE', "%$objective%")
->where('reception', 'LIKE', "%$reception%")
->orderBy('id', 'DESC')
->paginate();
} else {
$agreements = Agreements::where('id', '0')->orderBy('id', 'DESC')->paginate();
}
}
} else {

$agreements = Agreement::orderBy('id', 'DESC')
->id($id)
->name($name)
->countries($countries)
->legalInstrument($legalInstrument)
->instrumentType($instrumentType)
->objective($objective)
->reception($reception)
->paginate();
}
 */
        $agreements = Agreement::orderBy('id', 'DESC')
            ->id($id)
            ->name($name)
            ->countries($countries)
            ->person($people)
            ->legalInstrument($legalInstrument)
            ->instrumentType($instrumentType)
            ->objective($objective)
            ->reception($reception)
            ->paginate();
        return view('agreements.index', compact('name', 'reception', 'countries', 'legalInstrument', 'instrumentType', 'objective', 'people', 'agreements'));
    }
    public function index2(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $countries = $request->get('countries');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $reception = $request->get('reception');
        $people = $request->get('people_id');

        /*if ($people) {
        if (str_contains($people, ' - ')) {
        $splitName = explode(' - ', $request->get('people_id'));
        $agreements = Person::find($splitName[0])->agreements()
        ->where('name', 'LIKE', "%$name%")
        ->where('countries', 'LIKE', "%$countries%")
        ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
        ->where('instrumentType', 'LIKE', "%$instrumentType%")
        ->where('objective', 'LIKE', "%$objective%")
        ->where('reception', 'LIKE', "%$reception%")
        ->orderBy('id', 'DESC')
        ->paginate();
        } else {
        $person = Person::where('name', 'LIKE', "%$people%")->first();
        if (!empty($person)) {
        $agreements = $person->agreements()
        ->where('name', 'LIKE', "%$name%")
        ->where('countries', 'LIKE', "%$countries%")
        ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
        ->where('instrumentType', 'LIKE', "%$instrumentType%")
        ->where('objective', 'LIKE', "%$objective%")
        ->where('reception', 'LIKE', "%$reception%")
        ->orderBy('id', 'DESC')
        ->paginate();
        } else {
        $agreements = Agreements::where('id', '0')->orderBy('id', 'DESC')->paginate();
        }
        }
        } else {

        $agreements = Agreement::orderBy('id', 'DESC')
        ->id($id)
        ->name($name)
        ->countries($countries)
        ->legalInstrument($legalInstrument)
        ->instrumentType($instrumentType)
        ->objective($objective)
        ->reception($reception)
        ->paginate();
        }*/
        $agreements = Agreement::orderBy('id', 'DESC')
            ->id($id)
            ->name($name)
            ->countries($countries)
            ->person($people)
            ->legalInstrument($legalInstrument)
            ->instrumentType($instrumentType)
            ->objective($objective)
            ->reception($reception)
            ->paginate();
        return view('agreements.index2', compact('name', 'reception', 'countries', 'legalInstrument', 'instrumentType', 'objective', 'people', 'agreements'));
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
        $files = $agreements->getFiles;
        $list = array($files);
        $cont = count($files);
        $file = FileAgreement::find(last($list)[$cont - 1]->id);
        return view('public.show', compact('agreements', 'file'));
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
        $users = $agreements->getUser;
        $files = $agreements->getFiles;
        $fecha = $agreements->start_date;

        return view('agreements.show', compact('agreements', 'users', 'files'));
    }
    public function edit($id)
    {
        $agreements = Agreement::find($id);
        $users = User::all();
        //buscar la dependencia y pasarlo a la vista (creo)
        return view('agreements.edit', compact('agreements', 'users'));
    }

    public function destroy($id)
    {
        $agreement = Agreement::find($id);
        $agreement->delete();

        return back()->with('info', "El documento '.$agreement->name.' ha sido eliminado.");
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
        if ($request->end_date) {
            $agreement->end_date = new Carbon($request->end_date);
        } else {
            $pre = new Carbon($request->reception);
            $final = $pre->addWeekDays(4);
            $agreement->end_date = $final;
        }
        $agreement->liable_user = $request->liable_user;
        $users = $request->users;
        $people = $request->people;
        $agreement->update();
        $agreement->users()->detach();
        foreach ($users as $user) {
            $activeUser = User::where('id', $user)->first();
            if (!$agreement->hasUser($activeUser->email)) {
                $email = $activeUser->email;
                $subject = "Asignación de documentos";
                $message = "Se le ha asignado el documento " . $request->name . " para revisión";
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
            $agreement->users()
                ->attach(User::where('id', $user)->first());
        }
        $agreement->people()->detach();
        $countries = '';
        $personString = '';
        if ($request->people) {
            foreach ($people as $person) {
                $agreement->people()
                    ->attach(Person::where('id', $person)->first());
                $personActive = Person::find($person);
                $countries .= $personActive->country . ' ; ';
                $personString .= $personActive->id . ' - ' . $personActive->name . ' ; ';
            }
        }

        if ($request->people_id) {
            $splitName = explode(' - ', $request->people_id);
            $agreement->people()
                ->attach(Person::where('id', $splitName[0])->first());
            $personActive = Person::find($splitName[0]);
            $countries .= $personActive->country . ' ; ';
            $personString .= $personActive->id . ' - ' . $personActive->name . ' ; ';

        }
        $agreement->countries = $countries;
        $agreement->person = $personString;
        $agreement->update();
        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
            //Archivo
            $file_Name = new FileAgreement();
            $file_Name->name = $file_path;
            $file_Name->save();
            //Convenio
            $agreement->files()
                ->attach(FileAgreement::where('id', $file_Name->id)->first());
        }

        return redirect()->route('Agreement.index')->with('info', 'El Documento ' . $agreement->name . ' ha sido actualizado');
    }
    public function store(AgreementRequest $request)
    {
        $agreement = new Agreement();
        $agreement->name = $request->name;
        $agreement->reception = $request->reception;
        $agreement->objective = $request->objective;
        $agreement->legalInstrument = $request->legalInstrument;
        $agreement->instrumentType = $request->instrumentType;
        $agreement->scope = $request->scope;
        $agreement->status = "Revisión";
        $agreement->liable_user = $request->liable_user;
        $agreement->start_date = new Carbon($request->reception);
        if ($request->end_date) {
            $agreement->end_date = new Carbon($request->end_date);
        } else {
            $pre = new Carbon($request->reception);
            $final = $pre->addWeekDays(4);
            $agreement->end_date = $final;
        }
        $users = $request->users;
        if (Agreement::where('name', $agreement->name)->exists()) {
            return back()->with('info', 'El Documento ' . $agreement->name . ' ya existe.');
        } else {
            $agreement->save();
            foreach ($users as $user) {
                $activeUser = User::where('id', $user)->first();
                $agreement->users()
                    ->attach(User::where('id', $user)->first());
                $email = $activeUser->email;
                $subject = "Asignación de documentos";
                $message = " Se le ha asignado el documento " . $request->name . ", cuenta con 5 días para su revisión, desde " . $agreement->start_date->format('d-m-y') . " hasta " . $agreement->end_date->format('d-m-y');
                Mail::to($email)->send(new SendEmail($subject, $message));
            }

            //agregando partes
            $acturl = urldecode($request->ListaPro); //decodifico el JSON
            $people = json_decode($acturl);
            $countries = '';
            $personString = '';
            $agreement->countries = $countries;
            $agreement->person = $personString;
            $agreement->update();
            foreach ($people as $peopleSelected) {
                $splitPerson = explode(' - ', $peopleSelected->id_pro);
                $agreement->people()
                    ->attach(Person::where('id', $splitPerson[0])->first());
                $personActive = Person::find($splitPerson[0]);
                $countries .= $personActive->country . ' ; ';
                $personString .= $personActive->id . ' - ' . $personActive->name . ' ; ';
            }
            $agreement->countries = $countries;
            $agreement->person = $personString;
            $agreement->update();
        }
        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
            //Archivo
            $file_Name = new FileAgreement();
            $file_Name->name = $file_path;
            $file_Name->save();
            //Convenio
            $agreement->files()
                ->attach(FileAgreement::where('id', $file_Name->id)->first());
        }
        return redirect()->route('Agreement.index')->with('info', 'El Documento ' . $agreement->name . ' ha sido agregado');
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
