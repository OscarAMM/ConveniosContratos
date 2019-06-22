<?php

use Illuminate\Database\Seeder;
use App\FinalRegister;
use App\LegalInstrument;
use App\Person;

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
            /*Inicio
            |Número|
            ID interno|
            Fecha firma|
            Fecha informa|
            Vigencia de|
            Vigencia hasta|
            Año|
            Mes|
            Tipo vigencia|
            Instrumento jurídico|
            Instrumento jurídico bis|
            Tipo|
            Publicar|
            Nacional|
            Nombre|
            Objetivos|
            Instituciones y dependencias|
            Paises|
            Compromisos|
            Observación|
            Fecha final|
            Motivo|
            Fin
            $table->text('name'); 15
            $table->text('objective')->nullable(); 16
            $table->string('legalInstrument')->nullable(); 10
            $table->string('registerNumber')->nullable(); 1
            $table->date('signature')->nullable(); 3
            $table->date('session')->nullable(); 4
            $table->text('observation')->nullable(); 20
            $table->string('scope')->nullable(); 14
            $table->boolean('hide')->nullable(); 13
            $table->string('instrumentType')->nullable(); 12
            $table->date('start_date')->nullable(); 5
            $table->date('end_date')->nullable(); 6
            $table->string('status')->nullable(); Finalizado
            $table->text('countries')->nullable(); 18 
            $table->text('person')->nullable(); 17

            
            */
            $filename = 'juridico.txt';
            $contents = Storage::get($filename);
            //dd($contents);
            foreach (explode("<FIN>", $contents) as $line){
                $document=New FinalRegister();
                $splitName = explode('|', $line);
                if (!empty($splitName[15])) {
                    $document->name=$splitName[15];
                    echo $splitName[15];
                }
                if (!empty($splitName[16])) {
                    $document->objective=$splitName[16];
                }
                if (!empty($splitName[10])) {
                    //verificacion de instrumento
                    $instrument = new LegalInstrument();
                    $instrument->name=$splitName[10];
                    if (LegalInstrument::where('name', 'LIKE', "%{$instrument->name}%")->exists()) {
                        $document->legalInstrument=$splitName[16];
                    } else {
                        $document->legalInstrument=$splitName[16];
                        $instrument->save();
                    }
                }
                
                if (!empty($splitName[1])) {
                    $document->registerNumber=$splitName[1];
                }
                if (!empty($splitName[3])) {
                    $document->signature=$splitName[3];
                }
                if (!empty($splitName[4])) {
                    $document->session=$splitName[4];
                }
                if (!empty($splitName[20])) {
                    $document->observation=$splitName[20];
                }
                if (!empty($splitName[14])) {
                    $document->scope=$splitName[14];
                }
                if (!empty($splitName[13])) {
                    if($splitName[13]=='yes'){
                        $document->hide=true;
                    }else{
                        $document->hide=false;
                    }
                }
                if (!empty($splitName[12])) {
                    $document->instrumentType=$splitName[12];
                }
                if (!empty($splitName[5])) {
                    $document->start_date=$splitName[5];
                }
                if (!empty($splitName[6])) {
                    $document->end_date=$splitName[6];
                }
                $document->status='Finalizado';

                if (!empty($splitName[17])) {
                    $countries='';
                    $personString='';
                    $arrayPerson=explode("^", $splitName[17]);
                    $arrayCountries=explode("^", $splitName[18]);
                    $cont=count($arrayCountries);
                    foreach ($arrayPerson as $line2) {
                        //verificacion de person
                        $person = new Person();
                        $person->name=$line2;
                        $person->country=$arrayCountries[$cont-1];
                        $person->personType='Indefinido';
                        if (Person::where('name', 'LIKE', "%{$person->name}%")->exists()) {
                            $personActive=Person::where('name', $person->name)->first();
                            $document->people()->attach(Person::where('id', $personActive->id)->first());
                            $countries.=$personActive->country.' ; ';
                            $personString.=$personActive->id.' - '.$person->name.' ; ';
                        } else {
                            $person->save();
                            $personActive=Person::where('name', $person->name)->first();
                            $document->people()->attach(Person::where('id', $personActive->id)->first());
                            $countries.=$personActive->country.' ; ';
                            $personString.=$personActive->id.' - '.$personActive->name.' ; ';
                        }
                    }
                    $document->person=$personString;  
                    $document->countries=$countries;  
                }
                $document->save();
                
            }
            
            /*
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
            $document->person='Indefinido';---
            $document->hide=false;
            $document->status='Finalizado';
            $document->save();

            }*/
        }
        catch (Illuminate\Filesystem\FileNotFoundException $exception)
        {
            die("No existe el archivo");
        }
        

    }
}