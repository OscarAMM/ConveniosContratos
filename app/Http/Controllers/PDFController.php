<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\Agreement;

class PDFController extends Controller
{
    function index(){
       // $custom_data = $this->get_custom_data();
       $custom_data = Agreement::all();
        return view('PDFGenerator.dynamic_pdf',compact('custom_data'));
    }
    /*
     function get_custom_data(){
         $custom_data = DB::table('agreements')->limit(10)->get();
         return $custom_data;
     }
     function pdf(){
         $pdf = \App::make('dompdf.wrapper'); 
            echo "ctm Irving";
         $pdf->loadHTML($this->convert_customer_data_to_html());
         $pdf->stream();
         return "tuptm";
     }
     function convert_customer_data_to_html(){
         $custom_data = $this->get_custom_data();
         $output = '<h3 align ="center">Datos de prueba</h3>
         <table width="100%" style="border-collapse:collapse; border: 0px;">
         <tr>
                <th style = "border: 1px solid;
                padding: 12px; " >Id</th>
                <th style = "border: 1px solid;
                padding: 12px; " >Nombre</th>
                <th style = "border: 1px solid;
                padding: 12px; " >Recepción</th>
                <th style = "border: 1px solid;
                padding: 12px; ">Objetivo</th>
                <th style = "border: 1px solid;
                padding: 12px; " >Fecha de validez</th>
                <th style = "border: 1px solid;
                padding: 12px; ">Ámbito</th>
            </tr>
            
         ';
         foreach($custom_data as $data){
             $output = '<tr>
             <th style = "border: 1px solid;
             padding: 12px; " >'.$data->id.'</th>
             <th style = "border: 1px solid;
             padding: 12px; " >'.$data->name .'</th>
             <th style = "border: 1px solid;
             padding: 12px; " >' .$data->reception.' </th>
             <th style = "border: 1px solid;
             padding: 12px; ">' .$data->objective. '</th>
             <th style = "border: 1px solid;
             padding: 12px; " >' .$data->agreementValidity.'</th>
             <th style = "border: 1px solid;
             padding: 12px; ">' .$data->scope .'</th>
         </tr>';
         }
         $output = '</table>';
         return $output;
     }*/
     public function downloadPDF($id){
         $custom_data = Agreement::find($id);
         $pdf = PDF::loadView('PDFGenerator.pdf', compact('custom_data'));
         return $pdf->download('reporte.pdf');
     }

}
