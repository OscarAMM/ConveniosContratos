<?php

namespace App\Http\Controllers;

use App\FinalRegister;
use App\Agreement;
use DB;

use PhpOffice\PhpWord\TemplateProcessor;
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
        $session = $request->get('session');
        $start_signature = $request->get('start_signature');
        $end_signature = $request->get('end_signature');
        /*$scopeE= count(DB::table('final_registers')
            ->whereBetween('signature', [$start_signature, $end_signature])->where('signature', 'Estatal'));
        $scopeN = DB::table('final_registers')
            ->whereBetween('signature', [$start_signature, $end_signature])->where('signature', 'Nacional')->count();
        $scopeI = DB::table('final_registers')
            ->whereBetween('signature', [$start_signature, $end_signature])->where('signature', 'Internacional')->count();*/
        if ($start_signature||$end_signature||$session) {
            /*$docs = DB::table('final_registers')
            ->whereBetween('signature', [$start_signature, $end_signature])->paginate(15);*/
            $docs=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->paginate();
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->count();
            $scopeN=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->count();
            $scopeI=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
        } else {
            $docs = FinalRegister::orderBy('id', 'ASC')
            ->session($session)
            ->paginate();
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->count();
            $scopeN=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->count();
            $scopeI=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
        }
        return view('docs.index', compact('session', 'start_signature', 'end_signature', 'scopeE', 'scopeN', 'scopeI', 'docs', 'IGeneral', 'ISpecific', 'IOthers'));
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
    public function store(Request $request, $id)
    {
        $template = new TemplateProcessor('plantillaDocument.docx');
        $document=Agreement::find($id);
        $template->setValue('name', $document->name);
        $template->setValue('reception', $document->reception);
        $template->setValue('end_date', $document->end_date);
        $template->setValue('objective', $document->objective);
        $template->setValue('scope', $document->scope);
        $template->setValue('liable_user', $document->liable_user);
        $template->setValue('status', $document->status);
        $people = '';
        $users = '';
        foreach ($document->getUser as $user) {
            $users.='<w:br />'.$user->name.' - '.$user->email;
        }
        foreach ($document->getPeople as $person) {
            $people.='<w:br />'.$person->name;
        }
        $template->setValue('users', $users);
        $template->setValue('people', $people);

        $template->saveAs('documentsWord/'.$document->name.'.docx');
        return response()->download(public_path('documentsWord/'.$document->name.'.docx'))->deleteFileAfterSend(true);

        /*
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

        $text = $section->addText('Estado:',array('name' => 'Arial', 'size' => 14, 'bold' => false));
        $text = $section->addText($document->status);
        //ejemplo de como poner imagenes
        //$section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('documentsWord/'.$document->name.'.docx');
        return response()->download(public_path('documentsWord/'.$document->name.'.docx'));*/
    }
    public function storeFinal(Request $request, $id)
    {
        //
        $template = new TemplateProcessor('plantillaSICC.docx');
        $document=FinalRegister::find($id);
        $template->setValue('name', $document->name);
        $template->setValue('registerNumber', $document->registerNumber);
        $template->setValue('legalInstrument', $document->legalInstrument);
        $template->setValue('instrumentType', $document->instrumentType);
        $template->setValue('end_date', $document->end_date);
        $template->setValue('objective', $document->objective);
        $template->setValue('scope', $document->scope);
        $template->setValue('status', $document->status);
        $template->setValue('signature', $document->signature);
        $template->setValue('start_date', $document->start_date);
        $template->setValue('session', $document->session);
        $people = '';
        foreach ($document->getPeople as $person) {
            $people.='<w:br />'.$person->name;
        }
        $template->setValue('people', $people);

        if ($document->hide) {
            $template->setValue('hide', 'Visible');
        } else {
            $template->setValue('hide', 'No visible');
        }
        

        $template->saveAs('finalWord/'.$document->name.'.docx');
        return response()->download(public_path('finalWord/'.$document->name.'.docx'))->deleteFileAfterSend(true);
        
        /*
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

        $text = $section->addText('Estado:',array('name' => 'Arial', 'size' => 14, 'bold' => false));
        $text = $section->addText($document->status);
        //ejemplo de como poner imagenes
        //$section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('finalWord/'.$document->name.'.docx');
        return response()->download(public_path('finalWord/'.$document->name.'.docx'));*/
    }
    public function storeComments(Request $request, $id)
    {
        
        //Comentarios sin plantilla
        $document=Agreement::find($id);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->addTitleStyle(null, array('size' => 20, 'bold' => true));
        $section = $phpWord->addSection();
        $text = $section->addTitle('Historial de: '.$document->name, 0);
        foreach ($document->getComments as $comment) {
            $text = $section->addText('Asunto: '.$comment->topic);
            $text=\PhpOffice\PhpWord\Shared\Html::addHtml($section, 'Comentario: '.$comment->comment);
            $text = $section->addText('Realizado por: '.$comment->user);
            $text = $section->addText('Fecha: '.$comment->created_at.'<w:br />');
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('commentsWord/'.'Comments'.$document->name.'.docx');
        return response()->download(public_path('commentsWord/'.'Comments'.$document->name.'.docx'));

        //Comentarios con plantilla
       /* $document=Agreement::find($id);
        $template = new TemplateProcessor('plantillaComments.docx');
        $template->setValue('name',$document->name);
        $comments = '';
        foreach ($document->getComments as $comment) {
            $comments.='<w:br />'.'Asunto: '.$comment->topic
            .'<w:br />'.'Comentario: '.strip_tags($comment->comment)
            .'<w:br />'.'Realizado por: '.$comment->user
            .'<w:br />'.'Fecha: '.$comment->created_at.'<w:br />';
        }
        $template->setValue('comments', $comments);
        $template->saveAs('commentsWord/'.'Comments'.$document->name.'.docx');
        return response()->download(public_path('commentsWord/'.'Comments'.$document->name.'.docx'))->deleteFileAfterSend(true);*/
    }
    public function storeReports(Request $request)
    {
        $session = $request->get('session');
        $start_signature = $request->get('start_signature');
        $end_signature = $request->get('end_signature');
        if ($start_signature||$end_signature||$session) {
            $docs=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->paginate();
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->count();
            $scopeN=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->count();
            $scopeI=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
        } else {
            $docs = FinalRegister::orderBy('id', 'ASC')
            ->session($session)
            ->paginate();
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->count();
            $scopeN=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->count();
            $scopeI=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
        }

        /*foreach ($docs as $doc) {
            //campos de los documentos, faltan por añadir
            echo $doc->name.'-';
        }*/
        $template = new TemplateProcessor('plantillaReports.docx');
        $template->setValue('title', 'Reporte');
        $template->setValue('scopeE', $scopeE);
        $template->setValue('scopeN', $scopeN);
        $template->setValue('scopeI', $scopeI);
        $template->setValue('IGeneral', $IGeneral);
        $template->setValue('ISpecific', $ISpecific);
        $template->setValue('IOthers', $IOthers);

        $documents = '';
        foreach ($docs as $doc) {
            //campos de los documentos, faltan por añadir
            $documents.=
             '<w:br />'.'Nombre: '.$doc->name
             .'<w:br />'.'Objetivo: '.$doc->objective
             .'<w:br />'.'Fecha de firma: '.$doc->signature
             .'<w:br />'.'Fecha de fin: '.$doc->end_date
            .'<w:br />';
        }
        $template->setValue('documents', $documents);
        $template->saveAs('reportsWord/'.'Reporte.docx');
        return response()->download(public_path('reportsWord/'.'Reporte.docx'))->deleteFileAfterSend(true);
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
