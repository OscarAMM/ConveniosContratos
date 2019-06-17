<?php

use Illuminate\Database\Seeder;
use App\FinalRegister;
use Carbon\Carbon;


class FinalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try
        {
            $filename = 'Lista.txt';
            $contents = Storage::get($filename);
            //dd($contents);//
            
            
            foreach (explode("\r\n", $contents) as $key=>$line){
                
                $splitName = explode('##', $line);
                $document=New FinalRegister();
                if(!empty($splitName[0])){
                    switch ($splitName[0]) {
                        case starts_with($splitName[0],'Objetivo'):
                            $resultado = substr($splitName[0], 9);
                            $document->objective=$resultado;
                            break;
                        case starts_with($splitName[0],'Fecha de firma'):
                            $resultado = substr($splitName[0], 19);
                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';   
                            }
                            $document->signature=substr($date[4],0,4).'-'.$mes.'-'.$date[0];
                            break;
                        case starts_with($splitName[0],'Vigencia'):
                            $resultado = substr($splitName[0], 23);

                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';
                            }
                            $document->start_date=substr($date[4],0,4).'-'.$mes.'-'.$date[0];                            break;
                        case starts_with($splitName[0],'Caducidad'):
                            $resultado = substr($splitName[0], 21);

                            $date=explode(' ',$resultado);
                            if(!empty($date[0])&&!empty($date[2])&&!empty($date[4])&&empty($date[5])&&empty($date[6])){
                                $mes='';
                                if($date[2]=='enero'){
                                    $mes='01';
                                }if($date[2]=='febrero'){
                                    $mes='02';
                                }if($date[2]=='marzo'){
                                    $mes='03';
                                }if($date[2]=='abril'){
                                    $mes='04';
                                }if($date[2]=='mayo'){
                                    $mes='05';
                                }if($date[2]=='junio'){
                                    $mes='06';
                                }if($date[2]=='julio'){
                                    $mes='07';
                                }if($date[2]=='agosto'){
                                    $mes='08';
                                }if($date[2]=='septiembre'){
                                    $mes='09';
                                }if($date[2]=='octubre'){
                                    $mes='10';
                                }if($date[2]=='noviembre'){
                                    $mes='11';
                                }if($date[2]=='diciembre'){
                                    $mes='12';
                                }
                                $fecha=$mes.'-'.$date[0].'-'.substr($date[4],0,4);
                                $fecha_array = explode('-', $fecha);
                                $fechaA      = strtotime($fecha_array[1]."-".$fecha_array[0]."-".$fecha_array[2]);
                                if($fechaA != "" AND  checkdate(date("m",$fechaA), date("d",$fechaA), date("Y",$fechaA)) === true){
                                    //coNtinuas tu codigo
                                    $document->end_date=date("Y-m-d",$fechaA);
                                }else{
                                    $document->observation=$resultado;
                                }  
//                                echo "<br> ".date("Y-m-d",$fechaA);
//                                $document->end_date=substr($date[4],0,4).'-'.$mes.'-'.$date[0]; 
                                break;
                            }else{
                                $document->observation=$resultado;
                                break;
                            }
                            
                        default:  
                        $splitName2=explode('.', $splitName[0]);
                        $str='';
                        $cont=0;
                        foreach($splitName2 as $string){
                            if($cont>0){
                                $str.=$string;
                            }
                            $cont++;
                        }
                        $document->name=$str;
                        echo $str.' - ';
                    }
                }
                if(!empty($splitName[1])){
                    switch ($splitName[1]) {
                        case starts_with($splitName[1],'Objetivo'):
                            $resultado = substr($splitName[1], 9);
                            $document->objective=(string)$resultado;
                            break;
                        case starts_with($splitName[1],'Fecha de firma'):
                            $resultado = substr($splitName[1], 19);
                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';   
                            }
                            $document->signature=substr($date[4],0,4).'-'.$mes.'-'.$date[0];
                            break;
                        case starts_with($splitName[1],'Vigencia'):
                            $resultado = substr($splitName[1], 23);

                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';
                            }
                            $document->start_date=substr($date[4],0,4).'-'.$mes.'-'.$date[0];                            break;
                        case starts_with($splitName[1],'Caducidad'):
                            $resultado = substr($splitName[1], 21);

                            $date=explode(' ',$resultado);
                            if(!empty($date[0])&&!empty($date[2])&&!empty($date[4])&&empty($date[5])&&empty($date[6])){
                                $mes='';
                                if($date[2]=='enero'){
                                    $mes='01';
                                }if($date[2]=='febrero'){
                                    $mes='02';
                                }if($date[2]=='marzo'){
                                    $mes='03';
                                }if($date[2]=='abril'){
                                    $mes='04';
                                }if($date[2]=='mayo'){
                                    $mes='05';
                                }if($date[2]=='junio'){
                                    $mes='06';
                                }if($date[2]=='julio'){
                                    $mes='07';
                                }if($date[2]=='agosto'){
                                    $mes='08';
                                }if($date[2]=='septiembre'){
                                    $mes='09';
                                }if($date[2]=='octubre'){
                                    $mes='10';
                                }if($date[2]=='noviembre'){
                                    $mes='11';
                                }if($date[2]=='diciembre'){
                                    $mes='12';
                                }
                                $fecha=$mes.'-'.$date[0].'-'.substr($date[4],0,4);
                                $fecha_array = explode('-', $fecha);
                                $fechaA      = strtotime($fecha_array[1]."-".$fecha_array[0]."-".$fecha_array[2]);
                                if($fechaA != "" AND  checkdate(date("m",$fechaA), date("d",$fechaA), date("Y",$fechaA)) === true){
                                    //coNtinuas tu codigo
                                    $document->end_date=date("Y-m-d",$fechaA);
                                }else{
                                    $document->observation=$resultado;
                                }                                  break;
                            }else{
                                $document->observation=$resultado;
                                break;
                            }
                        default:  
                            $splitName2=explode('.', $splitName[1]);
                            $str='';
                            $cont=0;
                            foreach($splitName2 as $string){
                                if($cont>0){
                                    $str.=$string;
                                }
                                $cont++;
                            }
                            $document->name=$str;

                    }
                }
                if(!empty($splitName[2])){
                    switch ($splitName[2]) {
                        case starts_with($splitName[2],'Objetivo'):
                            $resultado = substr($splitName[2], 9);
                            $document->objective=$resultado;
                            break;
                        case starts_with($splitName[2],'Fecha de firma'):
                            $resultado = substr($splitName[2], 19);
                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';   
                            }
                            $document->signature=substr($date[4],0,4).'-'.$mes.'-'.$date[0];
                            break;
                        case starts_with($splitName[2],'Vigencia'):
                            $resultado = substr($splitName[2], 23);

                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';
                            }
                            $document->start_date=substr($date[4],0,4).'-'.$mes.'-'.$date[0];                            break;
                        case starts_with($splitName[2],'Caducidad'):
                            $resultado = substr($splitName[2], 21);

                            $date=explode(' ',$resultado);
                            if(!empty($date[0])&&!empty($date[2])&&!empty($date[4])&&empty($date[5])&&empty($date[6])){
                                $mes='';
                                if($date[2]=='enero'){
                                    $mes='01';
                                }if($date[2]=='febrero'){
                                    $mes='02';
                                }if($date[2]=='marzo'){
                                    $mes='03';
                                }if($date[2]=='abril'){
                                    $mes='04';
                                }if($date[2]=='mayo'){
                                    $mes='05';
                                }if($date[2]=='junio'){
                                    $mes='06';
                                }if($date[2]=='julio'){
                                    $mes='07';
                                }if($date[2]=='agosto'){
                                    $mes='08';
                                }if($date[2]=='septiembre'){
                                    $mes='09';
                                }if($date[2]=='octubre'){
                                    $mes='10';
                                }if($date[2]=='noviembre'){
                                    $mes='11';
                                }if($date[2]=='diciembre'){
                                    $mes='12';
                                }
                                $fecha=$mes.'-'.$date[0].'-'.substr($date[4],0,4);
                                $fecha_array = explode('-', $fecha);
                                $fechaA      = strtotime($fecha_array[1]."-".$fecha_array[0]."-".$fecha_array[2]);
                                if($fechaA != "" AND  checkdate(date("m",$fechaA), date("d",$fechaA), date("Y",$fechaA)) === true){
                                    //coNtinuas tu codigo
                                    $document->end_date=date("Y-m-d",$fechaA);
                                }else{
                                    $document->observation=$resultado;
                                }                                break;
                            }else{
                                $document->observation=$resultado;
                                break;
                            }
                        default:  
                            $splitName2=explode('.', $splitName[2]);
                            $str='';
                            $cont=0;
                            foreach($splitName2 as $string){
                                if($cont>0){
                                    $str.=$string;
                                }
                                $cont++;
                            }
                            $document->name=$str;

                    }
                }
                if(!empty($splitName[3])){
                    switch ($splitName[3]) {
                        case starts_with($splitName[3],'Objetivo'):
                            $resultado = substr($splitName[3], 9);
                            $document->objective=$resultado;
                            break;
                        case starts_with($splitName[3],'Fecha de firma'):
                            $resultado = substr($splitName[3], 19);
                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';   
                            }
                            $document->signature=substr($date[4],0,4).'-'.$mes.'-'.$date[0];
                            break;
                        case starts_with($splitName[3],'Vigencia'):
                            $resultado = substr($splitName[3], 23);

                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';
                            }
                            $document->start_date=substr($date[4],0,4).'-'.$mes.'-'.$date[0];                            break;
                        case starts_with($splitName[3],'Caducidad'):
                            $resultado = substr($splitName[3], 21);

                            $date=explode(' ',$resultado);
                            //if(!empty($date[0])&&ctype_digit($date[0])&&!empty($date[2])&&ctype_digit($date[2])&&!empty($date[4])&&ctype_digit($date[4])){
                                if(!empty($date[0])&&!empty($date[2])&&!empty($date[4])&&empty($date[5])&&empty($date[6])){

                                $mes='';
                                if($date[2]=='enero'){
                                    $mes='01';
                                }if($date[2]=='febrero'){
                                    $mes='02';
                                }if($date[2]=='marzo'){
                                    $mes='03';
                                }if($date[2]=='abril'){
                                    $mes='04';
                                }if($date[2]=='mayo'){
                                    $mes='05';
                                }if($date[2]=='junio'){
                                    $mes='06';
                                }if($date[2]=='julio'){
                                    $mes='07';
                                }if($date[2]=='agosto'){
                                    $mes='08';
                                }if($date[2]=='septiembre'){
                                    $mes='09';
                                }if($date[2]=='octubre'){
                                    $mes='10';
                                }if($date[2]=='noviembre'){
                                    $mes='11';
                                }if($date[2]=='diciembre'){
                                    $mes='12';
                                }
                                $fecha=$mes.'-'.$date[0].'-'.substr($date[4],0,4);
                                $fecha_array = explode('-', $fecha);
                                $fechaA      = strtotime($fecha_array[1]."-".$fecha_array[0]."-".$fecha_array[2]);
                                if($fechaA != "" AND  checkdate(date("m",$fechaA), date("d",$fechaA), date("Y",$fechaA)) === true){
                                    //coNtinuas tu codigo
                                    $document->end_date=date("Y-m-d",$fechaA);
                                }else{
                                    $document->observation=$resultado;
                                }                                  break;
                            }else{
                                $document->observation=$resultado;
                                break;
                            }
                        default:  
                            $splitName2=explode('.', $splitName[3]);
                            $str='';
                            $cont=0;
                            foreach($splitName2 as $string){
                                if($cont>0){
                                    $str.=$string;
                                }
                                $cont++;
                            }
                            $document->name=$str;
                    }
                }
                if(!empty($splitName[4])){
                    switch ($splitName[4]) {
                        case starts_with($splitName[4],'Objetivo'):
                            $resultado = substr($splitName[4], 9);
                            $document->objective=$resultado;
                            break;
                        case starts_with($splitName[4],'Fecha de firma'):
                            $resultado = substr($splitName[4], 19);
                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';   
                            }
                            $document->signature=substr($date[4],0,4).'-'.$mes.'-'.$date[0];
                            break;
                        case starts_with($splitName[4],'Vigencia'):
                            $resultado = substr($splitName[4], 23);

                            $date=explode(' ',$resultado);
                            $mes='';
                            if($date[2]=='enero'){
                                $mes='01';
                            }if($date[2]=='febrero'){
                                $mes='02';
                            }if($date[2]=='marzo'){
                                $mes='03';
                            }if($date[2]=='abril'){
                                $mes='04';
                            }if($date[2]=='mayo'){
                                $mes='05';
                            }if($date[2]=='junio'){
                                $mes='06';
                            }if($date[2]=='julio'){
                                $mes='07';
                            }if($date[2]=='agosto'){
                                $mes='08';
                            }if($date[2]=='septiembre'){
                                $mes='09';
                            }if($date[2]=='octubre'){
                                $mes='10';
                            }if($date[2]=='noviembre'){
                                $mes='11';
                            }if($date[2]=='diciembre'){
                                $mes='12';
                            }
                            $document->start_date=substr($date[4],0,4).'-'.$mes.'-'.$date[0];                            break;
                        case starts_with($splitName[4],'Caducidad'):
                            $resultado = substr($splitName[4], 21);

                            $date=explode(' ',$resultado);
                            if(!empty($date[0])&&!empty($date[2])&&!empty($date[4])&&empty($date[5])&&empty($date[6])){
                                $mes='';
                                if($date[2]=='enero'){
                                    $mes='01';
                                }if($date[2]=='febrero'){
                                    $mes='02';
                                }if($date[2]=='marzo'){
                                    $mes='03';
                                }if($date[2]=='abril'){
                                    $mes='04';
                                }if($date[2]=='mayo'){
                                    $mes='05';
                                }if($date[2]=='junio'){
                                    $mes='06';
                                }if($date[2]=='julio'){
                                    $mes='07';
                                }if($date[2]=='agosto'){
                                    $mes='08';
                                }if($date[2]=='septiembre'){
                                    $mes='09';
                                }if($date[2]=='octubre'){
                                    $mes='10';
                                }if($date[2]=='noviembre'){
                                    $mes='11';
                                }if($date[2]=='diciembre'){
                                    $mes='12';
                                }
                                $fecha=$mes.'-'.$date[0].'-'.substr($date[4],0,4);
                                $fecha_array = explode('-', $fecha);
                                $fechaA      = strtotime($fecha_array[1]."-".$fecha_array[0]."-".$fecha_array[2]);
                                if($fechaA != "" AND  checkdate(date("m",$fechaA), date("d",$fechaA), date("Y",$fechaA)) === true){
                                    //coNtinuas tu codigo
                                    $document->end_date=date("Y-m-d",$fechaA);
                                }else{
                                    $document->observation=$resultado;
                                }                                break;
                            }else{
                                $document->observation=$resultado;
                                break;
                            }
                        default:  
                            $splitName2=explode('.', $splitName[4]);
                            $str='';
                            $cont=0;
                            foreach($splitName2 as $string){
                                if($cont>0){
                                    $str.=$string;
                                }
                                $cont++;
                            }
                            $document->name=$str;

                    }
                }

            /*$document->legalInstrument='Indefinido';
            $document->registerNumber='Indefinido';
            $fecha_array = explode('-','01-01-2000' );
            $fechaA      = strtotime($fecha_array[1]."-".$fecha_array[0]."-".$fecha_array[2]);
            $document->session=date("Y-m-d",$fechaA);
            $document->scope='Indefinido';
            $document->instrumentType='Indefinido';
            $document->countries='Indefinido';
            $document->person='Indefinido';*/
            $document->hide=false;
            $document->status='Finalizado';
            $document->save();

            }
        }
        catch (Illuminate\Filesystem\FileNotFoundException $exception)
        {
            die("No existe el archivo");
        }
        

    }
}