<?php

namespace App\Http\Controllers;

use App\FinalRegister;
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
        $custom_data = FinalRegister::all();
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
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $text = $section->addText($request->get('name'));
        $text = $section->addText($request->get('email'));
        $text = $section->addText($request->get('number'), array('name' => 'Arial', 'size' => 20, 'bold' => true));
        //$section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Appdividend.docx');
        return response()->download(public_path('Appdividend.docx'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
