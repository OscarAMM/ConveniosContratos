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
        if ($start_signature||$end_signature||$session) {
            $docs=FinalRegister::orderBy('id', 'DESC')->whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->paginate();
            //General
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'General')->count();
            $scopeN=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'General')->count();
            $scopeI=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'General')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            $scopeT=$scopeE+$scopeN+$scopeI;
            $scopeT=(string)$scopeT;
            //Specific
            //We call FinalRegister model to verify the scope and count it
            $scopeES=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Específico')->count();
            $scopeNS=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Específico')->count();
            $scopeIS=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Específico')->count();
            //We make a parse String to print into the view
            $scopeES = (string) $scopeES;
            $scopeNS = (string) $scopeNS;
            $scopeIS = (string) $scopeIS;
            $scopeTS=$scopeES+$scopeNS+$scopeIS;
            $scopeTS=(string)$scopeTS;
            //Others
            //We call FinalRegister model to verify the scope and count it
            $scopeEO=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Otros')->count();
            $scopeNO=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Otros')->count();
            $scopeIO=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Otros')->count();
            //We make a parse String to print into the view
            $scopeEO = (string) $scopeEO;
            $scopeNO = (string) $scopeNO;
            $scopeIO = (string) $scopeIO;
            $scopeTO=$scopeEO+$scopeNO+$scopeIO;
            $scopeTO=(string)$scopeTO;

            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
            $ITotal=$IGeneral+$ISpecific+$IOthers;
            $ITotal=(string)$ITotal;
        } else {
            $docs = FinalRegister::orderBy('id', 'DESC')
            ->session($session)
            ->paginate(30);
            //General
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'General')->count();
            $scopeN=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'General')->count();
            $scopeI=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'General')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            $scopeT=$scopeE+$scopeN+$scopeI;
            $scopeT=(string)$scopeT;
            
            //Specific
            //We call FinalRegister model to verify the scope and count it
            $scopeES=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Específico')->count();
            $scopeNS=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Específico')->count();
            $scopeIS=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Específico')->count();
            //We make a parse String to print into the view
            $scopeES = (string) $scopeES;
            $scopeNS = (string) $scopeNS;
            $scopeIS = (string) $scopeIS;
            $scopeTS=$scopeES+$scopeNS+$scopeIS;
            $scopeTS=(string)$scopeTS;
            //Others
            //We call FinalRegister model to verify the scope and count it
            $scopeEO=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Otros')->count();
            $scopeNO=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Otros')->count();
            $scopeIO=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Otros')->count();
            //We make a parse String to print into the view
            $scopeEO = (string) $scopeEO;
            $scopeNO = (string) $scopeNO;
            $scopeIO = (string) $scopeIO;
            $scopeTO=$scopeEO+$scopeNO+$scopeIO;
            $scopeTO=(string)$scopeTO;
            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
            $ITotal=$IGeneral+$ISpecific+$IOthers;
            $ITotal=(string)$ITotal;
        }

        return view('docs.index', compact('session', 'start_signature', 'end_signature', 'scopeE', 'scopeN', 'scopeI','scopeT', 'scopeES', 'scopeNS', 'scopeIS','scopeTS', 'scopeEO', 'scopeNO', 'scopeIO','scopeTO', 'docs', 'IGeneral', 'ISpecific', 'IOthers','ITotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //
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

    }
    public function storeReports(Request $request)
    {
        $session = $request->get('session');
        $start_signature = $request->get('start_signature');
        $end_signature = $request->get('end_signature');
        if ($start_signature||$end_signature||$session) {
            //$docs=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->paginate();
            //General
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'General')->count();
            $scopeN=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'General')->count();
            $scopeI=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'General')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            $scopeT=$scopeE+$scopeN+$scopeI;
            $scopeT=(string)$scopeT;
            //Specific
            //We call FinalRegister model to verify the scope and count it
            $scopeES=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Específico')->count();
            $scopeNS=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Específico')->count();
            $scopeIS=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Específico')->count();
            //We make a parse String to print into the view
            $scopeES = (string) $scopeES;
            $scopeNS = (string) $scopeNS;
            $scopeIS = (string) $scopeIS;
            $scopeTS=$scopeES+$scopeNS+$scopeIS;
            $scopeTS=(string)$scopeTS;
            //Others
            //We call FinalRegister model to verify the scope and count it
            $scopeEO=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Otros')->count();
            $scopeNO=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Otros')->count();
            $scopeIO=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Otros')->count();
            //We make a parse String to print into the view
            $scopeEO = (string) $scopeEO;
            $scopeNO = (string) $scopeNO;
            $scopeIO = (string) $scopeIO;
            $scopeTO=$scopeEO+$scopeNO+$scopeIO;
            $scopeTO=(string)$scopeTO;

            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
            $ITotal=$IGeneral+$ISpecific+$IOthers;
            $ITotal=(string)$ITotal;
        } else {
            /*$docs = FinalRegister::orderBy('id', 'ASC')
            ->session($session)
            ->paginate();*/
            //General
            //We call FinalRegister model to verify the scope and count it
            $scopeE=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'General')->count();
            $scopeN=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'General')->count();
            $scopeI=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'General')->count();
            //We make a parse String to print into the view
            $scopeE = (string) $scopeE;
            $scopeN = (string) $scopeN;
            $scopeI = (string) $scopeI;
            $scopeT=$scopeE+$scopeN+$scopeI;
            $scopeT=(string)$scopeT;
            
            //Specific
            //We call FinalRegister model to verify the scope and count it
            $scopeES=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Específico')->count();
            $scopeNS=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Específico')->count();
            $scopeIS=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Específico')->count();
            //We make a parse String to print into the view
            $scopeES = (string) $scopeES;
            $scopeNS = (string) $scopeNS;
            $scopeIS = (string) $scopeIS;
            $scopeTS=$scopeES+$scopeNS+$scopeIS;
            $scopeTS=(string)$scopeTS;
            //Others
            //We call FinalRegister model to verify the scope and count it
            $scopeEO=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Estatal')->where('instrumentType', 'Otros')->count();
            $scopeNO=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Nacional')->where('instrumentType', 'Otros')->count();
            $scopeIO=FinalRegister::where('session', 'LIKE', "%$session%")->where('scope', 'Internacional')->where('instrumentType', 'Otros')->count();
            //We make a parse String to print into the view
            $scopeEO = (string) $scopeEO;
            $scopeNO = (string) $scopeNO;
            $scopeIO = (string) $scopeIO;
            $scopeTO=$scopeEO+$scopeNO+$scopeIO;
            $scopeTO=(string)$scopeTO;
            //We call Final Register model to verify the instrumentType and count it
            $IGeneral=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->count();
            $ISpecific=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Específico')->count();
            $IOthers=FinalRegister::where('session', 'LIKE', "%$session%")->where('instrumentType', 'Otros')->count();
            //PARSE STRING
            $IGeneral = (string) $IGeneral;
            $ISpecific = (string) $ISpecific;
            $IOthers = (string) $IOthers;
            $ITotal=$IGeneral+$ISpecific+$IOthers;
            $ITotal=(string)$ITotal;
        }

        $template = new TemplateProcessor('plantillaReports.docx');
        $template->setValue('title', 'Reporte');
        //General
        $template->setValue('scopeE', $scopeE);
        $template->setValue('scopeN', $scopeN);
        $template->setValue('scopeI', $scopeI);
        $template->setValue('scopeT', $scopeT);
        //Specific
        $template->setValue('scopeES', $scopeES);
        $template->setValue('scopeNS', $scopeNS);
        $template->setValue('scopeIS', $scopeIS);
        $template->setValue('scopeTS', $scopeTS);
        //Others
        $template->setValue('scopeEO', $scopeEO);
        $template->setValue('scopeNO', $scopeNO);
        $template->setValue('scopeIO', $scopeIO);
        $template->setValue('scopeTO', $scopeTO);
        //Datos de los documentos
        $template->setValue('IGeneral', $IGeneral);
        $template->setValue('ISpecific', $ISpecific);
        $template->setValue('IOthers', $IOthers);
        $template->setValue('ITotal', $ITotal);

        $template->saveAs('reportsWord/'.'Reporte.docx');
        return response()->download(public_path('reportsWord/'.'Reporte.docx'))->deleteFileAfterSend(true);
    }
    public function storeReportsGeneral(Request $request)
    {
        $session = $request->get('session');
        $start_signature = $request->get('start_signature');
        $end_signature = $request->get('end_signature');
        if ($start_signature||$end_signature||$session) {
            $docs = DB::table('final_registers')->orderBy('id', 'DESC')->whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->where('instrumentType', 'General')->get();
        } else {
            $docs = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('session', 'LIKE', "%{$session}%")
            ->where('instrumentType', 'General')
            ->get();

            /*$docs = FinalRegister::orderBy('id', 'DESC')
            ->session($session)
            ->instrumentType('General')
            ->paginate();*/
        }
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Convenios Generales');
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
        $template->saveAs('reportsWord/'.'Reporte de documentos generales.docx');
        return response()->download(public_path('reportsWord/'.'Reporte de documentos generales.docx'))->deleteFileAfterSend(true);
    }
    public function storeReportsSpecific(Request $request)
    {
        $session = $request->get('session');
        $start_signature = $request->get('start_signature');
        $end_signature = $request->get('end_signature');
        if ($start_signature||$end_signature||$session) {
            $docs = DB::table('final_registers')->orderBy('id', 'DESC')->whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->get();
        } else {
            $docs = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('session', 'LIKE', "%{$session}%")
            ->where('instrumentType', 'Específico')
            ->get();
        }
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Convenios Específicos');
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
        $template->saveAs('reportsWord/'.'Reporte de documentos especificos.docx');
        return response()->download(public_path('reportsWord/'.'Reporte de documentos especificos.docx'))->deleteFileAfterSend(true);
    }
    public function storeReportsOthers(Request $request)
    {
        $session = $request->get('session');
        $start_signature = $request->get('start_signature');
        $end_signature = $request->get('end_signature');
        if ($start_signature||$end_signature||$session) {
            $docs = DB::table('final_registers')->orderBy('id', 'DESC')->whereBetween('signature', [$start_signature, $end_signature])->where('session', 'LIKE', "%$session%")->paginate();
        } else {
            $docs = DB::table('final_registers')->orderBy('id', 'DESC')
            ->where('session', 'LIKE', "%{$session}%")
            ->where('instrumentType', 'Otros')
            ->get();
        }
        $template = new TemplateProcessor('plantillaReportsDocuments.docx');
        $template->setValue('title', 'Otros Documentos');
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
        $template->saveAs('reportsWord/'.'Reporte de otros documentos.docx');
        return response()->download(public_path('reportsWord/'.'Reporte de otros documentos.docx'))->deleteFileAfterSend(true);
    }
   
}
