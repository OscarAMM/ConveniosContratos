<?php

namespace App\Http\Controllers;
use DB;

use App\FileAgreement;
use App\FinalRegister;
use App\Http\Requests\FinalRegisterRequest;
use App\LegalInstrument;
use App\Person;
use App\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Text;

class FinalRegisterController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $countries = $request->get('countries');
        $scope = $request->get('scope');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        /*if ($people) {
            if (str_contains($people, ' - ')) {
                $splitName = explode(' - ', $people);
                $documents = Person::find($splitName[0])->final()
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                $documents2 = Person::find($splitName[0])->final()
                ->whereBetween('end_date', [Carbon::now(),'4000-01-01']) //CAMBIE AQUÍ DAVID este era docs3
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                $documents3 = Person::find($splitName[0])->final()
                ->whereBetween('end_date', ['1000-01-01', Carbon::now()])//CAMBIE AQUÍ DAVID este era dcos2
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                $documents4 = Person::find($splitName[0])->final()
                    ->where('observation', '!=','')
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
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
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                    $documents2 = $person->final()
                    ->whereBetween('end_date', [Carbon::now(),'4000-01-01']) //CAMBIE AQUÍ DAVID este era Docs3
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                    $documents3 = $person->final()
                    ->whereBetween('end_date', ['1000-01-01', Carbon::now()]) //CAMBIE AQUÍ DAVID este era Docs2
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                    $documents4 = $person->final()
                    ->where('observation', '!=','')
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
                    ->where('scope', 'LIKE', "%$scope%")
                    ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
                    ->where('instrumentType', 'LIKE', "%$instrumentType%")
                    ->where('objective', 'LIKE', "%$objective%")
                    ->where('signature', 'LIKE', "%$signature%")
                    ->where('end_date', 'LIKE', "%$end_date%")
                    ->orderBy('id', 'DESC')
                    ->paginate();
                } else {
                    $documents = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
                    $documents2 = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
                    $documents3 = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
                    $documents4 = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
                }
            }
        } else {
            $documents = FinalRegister::orderBy('id', 'DESC')
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
            $documents2 = FinalRegister::orderBy('id', 'DESC')
                ->whereBetween('end_date', [Carbon::now(),'4000-01-01']) //CAMBIE AQUÍ DAVID este era Docs3
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
            $documents3 = FinalRegister::orderBy('id', 'DESC')
                ->whereBetween('end_date', ['1000-01-01', Carbon::now()])
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
            $documents4 = FinalRegister::orderBy('id', 'DESC')
                ->where('observation', '!=','')
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
        }*/
        $documents = FinalRegister::orderBy('id', 'DESC')
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->person($people)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
            $documents2 = FinalRegister::orderBy('id', 'DESC')
                ->whereBetween('end_date', [Carbon::now(),'4000-01-01']) //CAMBIE AQUÍ DAVID este era Docs3
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->person($people)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
            $documents3 = FinalRegister::orderBy('id', 'DESC')
                ->whereBetween('end_date', ['1000-01-01', Carbon::now()])
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->person($people)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
            $documents4 = FinalRegister::orderBy('id', 'DESC')
                ->where('observation', '!=','')
                ->id($id)
                ->name($name)
                ->countries($countries)
                ->person($people)
                ->scope($scope)
                ->legalInstrument($legalInstrument)
                ->instrumentType($instrumentType)
                ->objective($objective)
                ->signature($signature)
                ->end_date($end_date)
                ->session($session)
                ->paginate();
        return view('finalregister.index', 
        compact('name','countries','scope','legalInstrument','instrumentType','objective','signature','end_date','session','people','documents','documents2','documents3','documents4'));
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
        if ($request->hide == "Mostrar") {
            $document->hide = true;
        } else {
            $document->hide = false;
        }
        $document->update();
        $people = $request->people;
        $document->people()->detach();
        $countries='';
        $personString='';
        if ($request->people) {
            foreach ($people as $person) {
                $document->people()
                ->attach(Person::where('id', $person)->first());
                $personActive=Person::find($person);
                $countries.=$personActive->country.' ; ';
                $personString.=$personActive->id.' - '.$personActive->name.' ; ';
            }
        }
        if ($request->people_id) {
            $splitName = explode(' - ', $request->people_id);
            $document->people()
                ->attach(Person::where('id', $splitName[0])->first());
            $personActive=Person::find($splitName[0]);
            $countries.=$personActive->country.' ; ';
            $personString.=$personActive->id.' - '.$personActive->name.' ; ';
        }
        $document->countries=$countries;
        $document->person=$personString;
        $document->update();
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
                $countries='';
                $personString='';
                foreach ($people as $peopleSelected) {
                    $splitPerson = explode(' - ', $peopleSelected->id_pro);
                    $document->people()
                ->attach(Person::where('id', $splitPerson[0])->first());
                    $countries.=Person::find($splitPerson[0])->country.' ; ';
                    $personString.=$peopleSelected->id_pro.' ; ';
                }
                $document->countries=$countries;
                $document->person=$personString;
                $document->update();
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
                $countries='';
                $personString='';
                if ($request->people) {
                    foreach ($people as $person) {
                        $document->people()
                ->attach(Person::where('id', $person)->first());
                        $personActive=Person::find($person);
                        $countries.=$personActive->country.' ; ';
                        $personString.=$personActive->id.' - '.$personActive->name.' ; ';
                    }
                }
                if ($request->people_id) {
                    $splitName = explode(' - ', $request->people_id);
                    $document->people()
                ->attach(Person::where('id', $splitName[0])->first());
                    $personActive=Person::find($splitName[0]);
                    $countries.=$personActive->country.' ; ';
                    $personString.=$personActive->id.' - '.$personActive->name.' ; ';
                }
                $document->countries=$countries;
                $document->person=$personString;
                $document->update();
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
        $countries = $request->get('countries');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $people=$request->get('people_id');
        /*
        if ($id||$name||$legalInstrument||$instrumentType||$objective||$signature||$end_date||$countries||$people) {
            if ($people) {
                if (str_contains($people, ' - ')) {
                    $splitName = explode(' - ', $people);
                    $documents = Person::find($splitName[0])->final()
                    ->where('name', 'LIKE', "%$name%")
                    ->where('countries', 'LIKE', "%$countries%")
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
                        ->where('countries', 'LIKE', "%$countries%")
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
                    ->countries($countries)
                    ->legalInstrument($legalInstrument)
                    ->instrumentType($instrumentType)
                    ->objective($objective)
                    ->signature($signature)
                    ->end_date($end_date)
                    ->paginate();
            }
        } else {
            $documents = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
        }*/
        //lo que va en vista<!--@if($document->hide&&$document->status=='Finalizado' &&$document->legalInstrument =='Convenio')-->

        if ($id||$name||$legalInstrument||$instrumentType||$objective||$signature||$end_date||$countries||$people) {
            $documents = FinalRegister::orderBy('id', 'DESC')
            //->where('name', 'LIKE', "%Convenio%")
            ->where('legalInstrument', 'LIKE', "%Convenio%")
            ->where('hide', "1")
            ->id($id)
            ->name($name)
            ->countries($countries)
            ->person($people)
            ->legalInstrument($legalInstrument)
            ->instrumentType($instrumentType)
            ->objective($objective)
            ->signature($signature)
            ->end_date($end_date)
            ->paginate();
        }else{
            $documents = FinalRegister::where('id', '0')->orderBy('id', 'DESC')->paginate();
        }
        
        return view('finalpublic.index', compact('documents'));
    }
    public function PublicShow($id)
    {
        $documents = FinalRegister::find($id);
        $files = $documents->getFiles;
       /* $list = array($files);
        $cont = count($files);
        $file = FileAgreement::find(last($list)[$cont - 1]->id);*/
        return view('finalpublic.show', compact('documents', 'files'));
    }
    public function storeAll(Request $request)
    {
        $name = $request->get('name');
        $countries = $request->get('countries');
        $scope = $request->get('scope');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        if($end_date){
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->where('end_date', 'LIKE', "%$end_date%")
            ->get();
        }else{
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->get();
        }
            
        
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Registros Finales');
        $docs = '';
        $cont=1;
        foreach ($documents as $doc) {
            //campos de los documentos, faltan por añadir
            $personString='';
            $document=FinalRegister::find($doc->id);
            foreach($document->getPeople as $person){
                $personString.='<w:br />'.$person->name;
            }
            if(empty($doc->end_date)){
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Observación: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->observation.'</w:t></w:r><w:r><w:t>';
            }else{
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de fin: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->end_date.'</w:t></w:r><w:r><w:t>';
            }
            
            $docs.=
            '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.$cont.' .- '.
            $doc->name.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Partes: '.'</w:t></w:r><w:r><w:t>'.str_replace("&", "Y",$personString)
            .'<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Objetivo: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.str_replace("&", "Y", $doc->objective).'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de firma: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->signature.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de inicio: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->start_date.'</w:t></w:r><w:r><w:t>'
            .'<w:br />'.$cadena
            .'<w:br />';
            $cont=$cont+1;
        }
        $template->setValue('documents', $docs);
        $template->saveAs('reportsWord/'.'RegistrosFinales.docx');
        //header("Content-Disposition: attachment; filename=RegistrosFinales.docx; charset=UTF-8");
//echo file_get_contents('reportsWord/'.'RegistrosFinales.docx');
        return response()->download(public_path('reportsWord/'.'RegistrosFinales.docx'))->deleteFileAfterSend(true);
    }
    public function storeV(Request $request)
    {
        $name = $request->get('name');
        $countries = $request->get('countries');
        $scope = $request->get('scope');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        if ($end_date) {
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->whereBetween('end_date', [Carbon::now(),'4000-01-01'])
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->where('end_date', 'LIKE', "%$end_date%")
            ->get();
        }else{
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->whereBetween('end_date', [Carbon::now(),'4000-01-01'])
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->get();
        }
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Registros Finales Vigentes');
        $docs = '';
        $cont=1;
        foreach ($documents as $doc) {
            //campos de los documentos, faltan por añadir
            $personString='';
            $document=FinalRegister::find($doc->id);
            foreach($document->getPeople as $person){
                $personString.='<w:br />'.$person->name;
            }
            if(empty($doc->end_date)){
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Observación: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->observation.'</w:t></w:r><w:r><w:t>';
            }else{
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de fin: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->end_date.'</w:t></w:r><w:r><w:t>';
            }
            
            $docs.=
            '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.$cont.' .- '.
            $doc->name.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Partes: '.'</w:t></w:r><w:r><w:t>'.str_replace("&", "Y",$personString)
            .'<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Objetivo: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.str_replace("&", "Y", $doc->objective).'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de firma: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->signature.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de inicio: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->start_date.'</w:t></w:r><w:r><w:t>'
            .'<w:br />'.$cadena
            .'<w:br />';
            $cont=$cont+1;
        }
        $template->setValue('documents', $docs);
        $template->saveAs('reportsWord/'.'Registros Finales Vigentes.docx');
        return response()->download(public_path('reportsWord/'.'Registros Finales Vigentes.docx'))->deleteFileAfterSend(true);
    }
    public function storeNV(Request $request)
    {
        $name = $request->get('name');
        $countries = $request->get('countries');
        $scope = $request->get('scope');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        if ($end_date) {
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->whereBetween('end_date', ['1000-01-01', Carbon::now()])
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->where('end_date', 'LIKE', "%$end_date%")
            ->get();
        }else{
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->whereBetween('end_date', ['1000-01-01', Carbon::now()])
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->get();
        }
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Registros Finales No Vigentes');
        $docs = '';
        $cont=1;
        foreach ($documents as $doc) {
            //campos de los documentos, faltan por añadir
            $personString='';
            $document=FinalRegister::find($doc->id);
            foreach($document->getPeople as $person){
                $personString.='<w:br />'.$person->name;
            }
            if(empty($doc->end_date)){
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Observación: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->observation.'</w:t></w:r><w:r><w:t>';
            }else{
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de fin: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->end_date.'</w:t></w:r><w:r><w:t>';
            }
            
            $docs.=
            '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.$cont.' .- '.
            $doc->name.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Partes: '.'</w:t></w:r><w:r><w:t>'.str_replace("&", "Y",$personString)
            .'<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Objetivo: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.str_replace("&", "Y", $doc->objective).'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de firma: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->signature.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de inicio: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->start_date.'</w:t></w:r><w:r><w:t>'
            .'<w:br />'.$cadena
            .'<w:br />';
            $cont=$cont+1;
        }
        $template->setValue('documents', $docs);
        $template->saveAs('reportsWord/'.'Registros Finales No Vigentes.docx');
        return response()->download(public_path('reportsWord/'.'Registros Finales No Vigentes.docx'))->deleteFileAfterSend(true);
    }
    public function storeOthers(Request $request)
    {
        $name = $request->get('name');
        $countries = $request->get('countries');
        $scope = $request->get('scope');
        $legalInstrument = $request->get('legalInstrument');
        $instrumentType = $request->get('instrumentType');
        $objective = $request->get('objective');
        $signature = $request->get('signature');
        $end_date = $request->get('end_date');
        $session = $request->get('session');
        $people=$request->get('people_id');
        if($end_date){
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('observation', '!=','')
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->where('end_date', 'LIKE', "%$end_date%")
            ->get();
        }else{
            $documents = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('observation', '!=','')
            ->where('name', 'LIKE', "%{$name}%")
            ->where('countries', 'LIKE', "%$countries%")
            ->where('person', 'LIKE', "%$people%")
            ->where('scope', 'LIKE', "%$scope%")
            ->where('legalInstrument', 'LIKE', "%$legalInstrument%")
            ->where('instrumentType', 'LIKE', "%$instrumentType%")
            ->where('objective', 'LIKE', "%$objective%")
            ->where('signature', 'LIKE', "%$signature%")
            ->where('session', 'LIKE', "%$session%")
            ->get();
        }
            
        
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Otros Registros Finales');
        $docs = '';
        $cont=1;
        foreach ($documents as $doc) {
            //campos de los documentos, faltan por añadir
            $personString='';
            $document=FinalRegister::find($doc->id);
            foreach($document->getPeople as $person){
                $personString.='<w:br />'.$person->name;
            }
            if(empty($doc->end_date)){
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Observación: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->observation.'</w:t></w:r><w:r><w:t>';
            }else{
                $cadena='</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de fin: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->end_date.'</w:t></w:r><w:r><w:t>';
            }
            
            $docs.=
            '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.$cont.' .- '.$doc->name.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Partes: '.'</w:t></w:r><w:r><w:t>'.str_replace("&", "Y",$personString)
            .'<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Objetivo: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.str_replace("&", "Y", $doc->objective).'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de firma: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->signature.'</w:t></w:r><w:r><w:t>'
            . '<w:br />'.'</w:t></w:r><w:r><w:rPr><w:b/></w:rPr><w:t> '.'Fecha de inicio: '.'</w:t></w:r><w:r><w:t>'.'</w:t></w:r><w:r><w:rPr></w:rPr><w:t xml:space="preserve"> '.$doc->start_date.'</w:t></w:r><w:r><w:t>'
            .'<w:br />'.$cadena
            .'<w:br />';
            $cont=$cont+1;
        }
        $template->setValue('documents', $docs);
        $template->saveAs('reportsWord/'.'Otros Registros Finales.docx');
        return response()->download(public_path('reportsWord/'.'Otros Registros Finales.docx'))->deleteFileAfterSend(true);
    }
}
