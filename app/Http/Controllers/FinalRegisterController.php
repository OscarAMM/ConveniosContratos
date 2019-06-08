<?php

namespace App\Http\Controllers;

use App\FileAgreement;
use App\FinalRegister;
use App\Http\Requests\FinalRegisterRequest;
use App\LegalInstrument;
use App\Person;
use App\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;

class FinalRegisterController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        if ($people) {
            if (str_contains($people, ' - ')) {
                $splitName = explode(' - ', $people);
                $documents = Person::find($splitName[0])->final()
                    ->where('name', 'LIKE', "%$name%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
            } else {
                $person=Person::where('name', 'LIKE', "%$people%")->first();
                if (!empty($person)) {
                    $documents = $person->final()
                    ->where('name', 'LIKE', "%$name%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                } else {
                    $documents = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
                }
            }
        } else {
            $documents = FinalRegister::orderBy('id', 'DESC')
                ->id($id)
                ->name($name)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
        }
        return view('finalregister.index', compact('documents'));
    }
    public function create()
    {
        $people = Person::all();
        $instrument = LegalInstrument::all();
        return view('finalregister.create', compact('people', 'instrument'));
    }
    public function show($id)
    {
        $documents = FinalRegister::find($id);
        $files = $documents->getFiles;
        return view('finalregister.show', compact('documents', 'files'));
    }
    public function edit($id)
    {
        $documents = FinalRegister::find($id);
        return view('finalregister.edit', compact('documents'));
    }
    public function destroy($id)
    {
        $document = FinalRegister::find($id);
        $document->delete();
        return back()->with('info', "El documento '.$document->name.' ha sido eliminado");
    }
    public function update(FinalRegisterRequest $request, $id)
    {
        $document = FinalRegister::find($id);
        $document->name = $request->name;
        $document->objective = $request->objective;
        $document->legalInstrument = $request->legalInstrument;
        $document->registerNumber = $request->registerNumber;
        $document->signature = $request->signature;
        $document->start_date = $request->start_date;
        $document->end_date = $request->end_date;
        $document->session = $request->session;
        $document->observation = $request->observation;
        $document->scope = $request->scope;
        $document->status = 'Finalizado';
        $document->instrumentType = $request->instrumentType;
        $document->end_date = $request->signature;
        if ($request->hide == "Mostrar") {
            $document->hide = true;
        } else {
            $document->hide = false;
        }
        $document->update();
        $people = $request->people;
        $document->people()->detach();
        foreach ($people as $person) {
            $document->people()
                ->attach(Person::where('id', $person)->first());
        }
        if ($request->people_id) {
            $splitName = explode(' - ', $request->people_id);
            $document->people()
                ->attach(Person::where('id', $splitName[0])->first());
        }
        return redirect()->route('FinalRegister.index')->with('info', 'El documento ' . $document->name . ' ha sido actualizado');
    }
    public function store(FinalRegisterRequest $request)
    {
        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('finalFiles/' . $file_path, \File::get($file));
            $file_Name = new FileAgreement();
            $file_Name->name = $file_path;
            $file_Name->save();

            $document = new FinalRegister();
            $document->name = $request->input('name');
            $document->objective = $request->objective;
            $document->legalInstrument = $request->legalInstrument;
            $document->registerNumber = $request->registerNumber;
            $document->signature = $request->signature;
            $document->start_date = $request->start_date;
            $document->end_date = $request->end_date;
            $document->session = $request->session;
            $document->observation = $request->observation;
            $document->scope = $request->scope;
            $document->status = 'Finalizado';
            $document->instrumentType = $request->instrumentType;
            $document->end_date = $request->signature;
            if ($request->hide == "Mostrar") {
                $document->hide = true;
            } else {
                $document->hide = false;
            }
            if (FinalRegister::where('name', $document->name)->exists()) {
                return back()->with('info', 'El documento ' . $document->name . ' ya existe.');
            } else {
                $document->save();
                $document->files()->attach(FileAgreement::where('id', $file_Name->id)->first());
                //agregando partes
            $acturl = urldecode($request->ListaPro); //decodifico el JSON
            $people = json_decode($acturl);
                foreach ($people as $peopleSelected) {
                    $splitPerson = explode(' - ', $peopleSelected->id_pro);
                    $document->people()
                ->attach(Person::where('id', $splitPerson[0])->first());
                }
            }
        } else {
            return back()->with('info', 'No seleccionó un archivo.');
        }
        
        return redirect()->route('FinalRegister.index')->with('info', 'El documento ' . $document->name . ' ha sido guardado');
    }
    public function showFile($id)
    {
        $file = FileAgreement::find($id);
        return storage::download('/finalFiles/' . $file->name);
    }
    //STORE FOR DOCUMENTS
    public function storeDocs(FinalRegisterRequest $request)
    {
        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('finalFiles/' . $file_path, \File::get($file));
            $file_Name = new FileAgreement();
            $file_Name->name = $file_path;
            $file_Name->save();

            $document = new FinalRegister();
            $document->name = $request->input('name');
            $document->objective = $request->objective;
            $document->legalInstrument = $request->legalInstrument;
            $document->registerNumber = $request->registerNumber;
            $document->signature = $request->signature;
            $document->start_date = $request->start_date;
            $document->end_date = $request->end_date;
            $document->session = $request->session;
            $document->observation = $request->observation;
            $document->scope = $request->scope;
            $document->status = 'Finalizado';
            $document->instrumentType = $request->instrumentType;
            $document->end_date = $request->signature;
            if ($request->hide == "Mostrar") {
                $document->hide = true;
            } else {
                $document->hide = false;
            }
            if (FinalRegister::where('name', $document->name)->exists()) {
                return back()->with('info', 'El documento ' . $document->name . ' ya existe.');
            } else {
                $document->save();
                $document->files()->attach(FileAgreement::where('id', $file_Name->id)->first());
                $people = $request->people;
                $document->people()->detach();
                foreach ($people as $person) {
                    $document->people()
                ->attach(Person::where('id', $person)->first());
                }
                if ($request->people_id) {
                    $splitName = explode(' - ', $request->people_id);
                    $document->people()
                ->attach(Person::where('id', $splitName[0])->first());
                }
                /*$acturl = urldecode($request->ListaPro); //decodifico el JSON
                $people = json_decode($acturl);
                foreach ($people as $peopleSelected) {
                    $splitPerson = explode(' - ', $peopleSelected->id_pro);
                    $document->people()
                        ->attach(Person::where('id', $splitPerson[0])->first());
                }*/
            }
        } else {
            return back()->with('info', 'No seleccionó un archivo.');
        }
        return redirect()->route('FinalRegister.index')->with('info', 'El documento ' . $document->name . ' ha sido guardado');
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
    public function formIndex($id)
    {
        $agreements = Agreement::find($id);

        return view('finalregister.createDocs', compact('agreements'));
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
    //PUBLIC SECTION
    public function indexPublic(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        if ($id||$name||$legalInstrument||$instrumentType||$objective||$signature||$end_date||$session||$people) {
            if ($people) {
                if (str_contains($people, ' - ')) {
                    $splitName = explode(' - ', $people);
                    $documents = Person::find($splitName[0])->final()
                        ->where('name', 'LIKE', "%$name%")
                        ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                        ->where('instrumentType', 'LIKE', "%$instrumentType%")
                        ->where('objective', 'LIKE', "%$objective%")
                        ->where('signature', 'LIKE', "%$signature%")
                        ->where('end_date', 'LIKE', "%$end_date%")
                        ->orderBy('id', 'DESC')
                        ->paginate();
                } else {
                    $person=Person::where('name', 'LIKE', "%$people%")->first();
                    if (!empty($person)) {
                        $documents = $person->final()
                        ->where('name', 'LIKE', "%$name%")
                        ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                        ->where('instrumentType', 'LIKE', "%$instrumentType%")
                        ->where('objective', 'LIKE', "%$objective%")
                        ->where('signature', 'LIKE', "%$signature%")
                        ->where('end_date', 'LIKE', "%$end_date%")
                        ->orderBy('id', 'DESC')
                        ->paginate();
                    } else {
                        $documents = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
                    }
                }
            } else {
                $documents = FinalRegister::orderBy('id', 'DESC')
                    ->id($id)
                    ->name($name)
                    ->legalInstrument($legalInstrument)
                    ->instrumentType($instrumentType)
                    ->objective($objective)
                    ->signature($signature)
                    ->end_date($end_date)
                    ->session($session)
                    ->paginate();
            }
        } else {
            $documents = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
        }
        
        return view('finalpublic.index', compact('documents'));
    }
    public function PublicShow($id)
    {
        $documents = FinalRegister::find($id);
        $files = $documents->getFiles;
        $list = array($files);
        $cont = count($files);
        $file = FileAgreement::find(last($list)[$cont - 1]->id);
        return view('finalpublic.show', compact('documents', 'file'));
    }
}
