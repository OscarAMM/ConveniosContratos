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
            /*
            TXT______
            Inicio
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
            _____
            BD Table 
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
                    //'UTF-8','ISO-8859-1//TRANSLIT'
                    $document->name=iconv('ISO-8859-1','UTF-8//IGNORE',$splitName[15]);
                    echo $splitName[15];
                }
                if (!empty($splitName[16])) {
                    $document->objective=iconv('ISO-8859-1','UTF-8//IGNORE',$splitName[16]);
                }
                if (!empty($splitName[10])) {
                    //verificacion de instrumento
                    $instrument = new LegalInstrument();
                    $instrument->name=iconv('ISO-8859-1','UTF-8//IGNORE',$splitName[10]);
                    if (LegalInstrument::where('name',$instrument->name)->exists()) {
                        $document->legalInstrument=$instrument->name;
                    } else {
                        $document->legalInstrument=$instrument->name;
                        $instrument->save();
                    }

                }
                
                if (!empty($splitName[1])) {
                    $document->registerNumber=$splitName[1];
                }
                if (!empty($splitName[3])&&$splitName[3]!='0'&&$splitName[3]!='?') {
                   
                    $splitDate=explode('/',$splitName[3]);
                    $year = DateTime::createFromFormat('y', $splitDate[2]);
                    $document->signature=$year->format('Y').'-'.$splitDate[1].'-'.$splitDate[0];
                }else{
                    $document->signature='0001-01-30';
                }
                if (!empty($splitName[4])&&$splitName[4]!='0'&&$splitName[4]!='?') {
                    $splitDate=explode('/',$splitName[4]);
                    $year = DateTime::createFromFormat('y', $splitDate[2]);
                    $document->session=$year->format('Y').'-'.$splitDate[1].'-'.$splitDate[0];
                }else{
                    $document->session='0001-01-30';
                }
                if (!empty($splitName[20])) {
                    $document->observation=iconv('ISO-8859-1','UTF-8//IGNORE',$splitName[20]);
                }
                if (!empty($splitName[14])) {
                    if ($splitName[13]=='yes') {
                        $document->scope='Nacional';
                    }else{
                        $document->scope='Internacional';
                    }
                }
                if (!empty($splitName[13])) {
                    if($splitName[13]=='yes'){
                        $document->hide=true;
                    }else{
                        $document->hide=false;
                    }
                }
                if (!empty($splitName[12])) {
                    $document->instrumentType=iconv('ISO-8859-1','UTF-8//IGNORE',$splitName[12]);
                }
                if (!empty($splitName[5])&&$splitName[5]!='0'&&$splitName[5]!='?') {
                    $splitDate=explode('/',$splitName[5]);
                    $year = DateTime::createFromFormat('y', $splitDate[2]);
                    $document->start_date=$year->format('Y').'-'.$splitDate[1].'-'.$splitDate[0];
                }else{
                    $document->start_date='0001-01-30';
                }
                if (!empty($splitName[6])&&$splitName[6]!='0'&&$splitName[6]!='?') {
                    echo $splitName[6].'---';
                    $splitDate=explode('/',$splitName[6]);
                    
                    $year = DateTime::createFromFormat('y', $splitDate[2]);
                    $document->end_date=$year->format('Y').'-'.$splitDate[1].'-'.$splitDate[0];
                    
                }
                $document->status='Finalizado';
                if (!empty($splitName[17])) {
                    $countries='';
                    $personString='';
                    $arrayPerson=explode("^", $splitName[17]);
                    $arrayCountries=explode("^", $splitName[18]);
                    $cont=count($arrayCountries);
                    $cont2=0;
                    foreach ($arrayPerson as $line2) {
                        if($line2!='<ERROR-FIRMAS>'&&!empty($line2)){
                            $person = new Person();
                            $person->name=iconv('ISO-8859-1','UTF-8//IGNORE',$line2);
                            $person->country=iconv('ISO-8859-1','UTF-8//IGNORE',$arrayCountries[$cont2]);
                            $person->personType='Indefinido';
                            if (!Person::where('name', $person->name)->exists()) {
                                $person->save();
                            }
                            $cont2=$cont2+1;
                        }
                        
                    }
                    $document->save();
                    foreach ($arrayPerson as $line2) {
                        if ($line2!='<ERROR-FIRMAS>'&&!empty($line2)) {
                            $personActive=Person::where('name', iconv('ISO-8859-1', 'UTF-8//IGNORE', $line2))->first();
                            $document->people()->attach(Person::where('id', $personActive->id)->first());
                            $countries.=$personActive->country.' ; ';
                            $personString.=$personActive->id.' - '.$personActive->name.' ; ';
                        }
                    }
                    $document->person=$personString;  
                    $document->countries=$countries;  

                }
                $document->update();
            }
            
        }
        catch (Illuminate\Filesystem\FileNotFoundException $exception)
        {
            die("No existe el archivo");
        }
        

    }
}