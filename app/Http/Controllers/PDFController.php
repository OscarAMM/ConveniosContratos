<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Contract;
use PDF;

class PDFController extends Controller
{
    public function index()
    {
        // $custom_data = $this->get_custom_data();
        //Se hace un llamado a los Agreement con el parámetro de alcance y se hace un conteo
        $custom_data = Agreement::all();
        $custom_agreement1 = Agreement::where('scope', 'Estatal')->count();
        $custom_agreement2 = Agreement::where('scope', 'Nacional')->count();
        $custom_agreement3 = Agreement::where('scope', 'Internacional')->count();
        //Se hace un parse de enteros a string para imprimir en la vista
        $custom_agreement2 = (string) $custom_agreement2;
        $custom_agreement1 = (string) $custom_agreement1;
        $custom_agreement3 = (string) $custom_agreement3;
        //Se hace llamado a los contratos
       

        //se pasa las variables creadas para ser llamadas en las vistas
        return view('PDFGenerator.dynamic_pdf', compact('custom_data', 'custom_agreement1', 'custom_agreement2', 'custom_agreement3'));
    }

    public function downloadPDF()
    {
        //Busca el agreement por el id y carga la vista del pdf con las variables dadas
        $custom_agreement1 = Agreement::where('scope', 'Estatal')->count();
        $custom_agreement2 = Agreement::where('scope', 'Nacional')->count();
        $custom_agreement3 = Agreement::where('scope', 'Internacional')->count();
        //Se hace un parse de enteros a string para imprimir en la vista
        $custom_agreement2 = (string) $custom_agreement2;
        $custom_agreement1 = (string) $custom_agreement1;
        $custom_agreement3 = (string) $custom_agreement3;
       
        $pdf = PDF::loadView('PDFgenerator.pdf', compact( 'custom_agreement1', 'custom_agreement2', 'custom_agreement3'));
        //Regresa la descarga del pdf
        return $pdf->download('reporte.pdf');
    }

}
