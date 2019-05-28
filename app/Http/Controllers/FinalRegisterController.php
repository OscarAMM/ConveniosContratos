<?php

namespace App\Http\Controllers;
use App\FinalRegister;
use App\Http\Requests\FinalRegisterRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\FileAgreement;
use App\LegalInstrument;
use App\Person;
use App\User;

class FinalRegisterController extends Controller
{
    public function index(){
        return view('finalregister.index');
    }
    public function create(){
        $people = Person::all();
        $instrument = LegalInstrument::all();
        return view('finalregister.create', compact('people','instrument'));
    }
    public function show($id){
        $documents = FinalRegister::find($id);

        return view();
    }
    public function store(FinalRegisterRequest $request){
        $file = $request->file('file');
        if($file){
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('finalFiles/'.$file_path, \File::get($file));
        }else{
            return back()->with('info', 'No seleccionó un archivo.');

        }
        $file_Name = new FileAgreement();
        $file_Name->name = $file_path;
        $file_Name->save();

        $document = new FinalRegister();
        $document->name = $request->name;
        $document->reception = $request->reception;
        $document->objective = $request->objective;
        $document->legalInstrument = $request->legalInstrument;
        $document->registerNumber = $request->registerNumber;
        $document->signature = $request->signature;
        $document->validity = $request->validity;
        $document->session = $request->session;
        $document->scope = $request->scope;
        $document->hide = $request->hide;
        $document->status = 'Finalizado';

        $document->instrumentType = $request->instrumentType;
        $document->end_date = $request->signature;
        
        if ($request->hide == "Mostrar") {
            $document->hide = true;
            } else {
            $document->hide = false;
            }
        $splitPeopleName = explode(' - ', $request->people_id);
        $document->people_id = $splitPeopleName[0];
        if(FinalRegister::where('name', $document->name)->exists()){
            return back()->with('info', 'El documento '.$document->name. ' ya existe.');
        }else{
            $document->save();
            $document->files()->attach(FileAgreement::where('id',$file_Name->id)->first());
        }
        
        return redirect()->route('FinalRegister.index')->with('info', 'El documento '.$document->name.' ha sido guardado');
    }
    
}
