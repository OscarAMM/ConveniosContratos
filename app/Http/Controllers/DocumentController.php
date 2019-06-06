<?php

namespace App\Http\Controllers;

use App\FinalRegister;
use App\Agreement;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->get('id');
        $session = $request->get('session');
        $docs = FinalRegister::orderBy('id', 'ASC')
            ->id($id)
            ->session($session)
            ->paginate();

        //We call FinalRegister model to verify the scope and count it
        $custom_data = $docs;
        $scopeE = FinalRegister::where('scope', 'Estatal')->count();
        $scopeN = FinalRegister::where('scope', 'Nacional')->count();
        $scopeI = FinalRegister::where('scope', 'Internacional')->count();
        //We make a parse String to print into the view
        $scopeE = (string) $scopeE;
        $scopeN = (string) $scopeN;
        $scopeI = (string) $scopeI;
        //We call Final Register model to verify the instrumentType and count it
        $IGeneral = FinalRegister::where('instrumentType', 'General')->count();
        $ISpecific = FinalRegister::where('instrumentType', 'Específico')->count();
        $IOthers = FinalRegister::where('instrumentType', 'Otros')->count();
        //PARSE STRING
        $IGeneral = (string) $IGeneral;
        $ISpecific = (string) $ISpecific;
        $IOthers = (string) $IOthers;
        return view('docs.index', compact('scopeE', 'scopeN', 'scopeI', 'docs', 'IGeneral', 'ISpecific', 'IOthers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /*$phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $text = $section->addText($request->get('name'));
        $text = $section->addText($request->get('email'));
        $text = $section->addText($request->get('number'), array('name' => 'Arial', 'size' => 20, 'bold' => true));
        //$section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($document->name.'.docx');
        return response()->download(public_path($document->name.'.docx'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $document=Agreement::find($id);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->addTitleStyle(null, array('size' => 20, 'bold' => true));
        $section = $phpWord->addSection();
        $text = $section->addTitle($document->name,0);         
        $text = $section->addText('Recepción:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->reception);  
        $text = $section->addText('Fecha final de revisión:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->end_date);
        $text = $section->addText('Objetivo:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->objective);
        $text = $section->addText('Ámbito:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->scope);
        $text = $section->addText('Partes:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        foreach($document->getPeople as $person){
            $text = $section->addText($person->name);        
        }
        $text = $section->addText('Responsable externo:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->liable_user);
        $text = $section->addText('Responsable(s) interno(s):',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        foreach($document->getUser as $user){
            $text = $section->addText($user->name.' - '. $user->email);        
        }
        /*Secciones de archivos, aun por confirmar si se agrega
        */
        $text = $section->addText('Estado:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->status);  
        //ejemplo de como poner imagenes      
        //$section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('documentsWord/'.$document->name.'.docx');
        return response()->download(public_path('documentsWord/'.$document->name.'.docx'));
    }
    public function storeFinal(Request $request,$id)
    {
        //
        $document=FinalRegister::find($id);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->addTitleStyle(null, array('size' => 20, 'bold' => true));
        $section = $phpWord->addSection();
        $text = $section->addTitle($document->name,0);         
        $text = $section->addText('Número de registro:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->registerNumber);  
        $text = $section->addText('Instrumento jurídico:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->legalInstrument);
        $text = $section->addText('Objetivo:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->objective);
        $text = $section->addText('Tipo de instrumento:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->instrumentType);
        $text = $section->addText('Observación:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->observation);
        $text = $section->addText('Fecha de firma:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->signature);
        $text = $section->addText('Fecha de inicio:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->start_date);
        $text = $section->addText('Fecha de fin:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->end_date);
        $text = $section->addText('Fecha de sesión:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->session);
        $text = $section->addText('Ámbito:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        $text = $section->addText($document->scope);
        $text = $section->addText('Visibilidad del documento:',array('name' => 'Arial', 'size' => 14, 'bold' => false));                 
        if($document->hide){
            $text = $section->addText('Visible');
        }else{
            $text = $section->addText('No Visible');
        }
        $text = $section->addText('Partes:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        foreach($document->getPeople as $person){
            $text = $section->addText($person->name);        
        }
        /*Secciones de archivos, aun por confirmar si se agrega
        */
        $text = $section->addText('Estado:',array('name' => 'Arial', 'size' => 14, 'bold' => false));         
        $text = $section->addText($document->status);  
        //ejemplo de como poner imagenes      
        //$section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('finalWord/'.$document->name.'.docx');
        return response()->download(public_path('finalWord/'.$document->name.'.docx'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
