<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class CommentController extends Controller
{
   /* public function store(Request $request){
        $validate = $this->Validate($request,[
            'comment' => 'required',
        ]);
    }*/
    public function store(CommentRequest $request)
    {
        $file = $request->file('file');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('files/' . $file_path, \File::get($file));
        } else {
            return back()->with('info', 'No selecciono un archivo.');
        }
        //Archivo
        $file_Name = new File();
        $file_Name->name = $file_path;
        $file_Name->save();
        

        //Contrato
        $comment = new Comment();
        $comment->topic = $request->topic;
        $comment->comment = $request->comment;/*
        $agreement=
        $contract->files()
                ->attach(File::where('id', $file_Name->id)->first());

        $users = $request->users;
        if (Contract::where('name', $contract->name)->exists()) {
            return back()->with('info', 'El contrato ya existe.');
        } else {
            $contract->save();
            foreach ($users as $user) {
                // echo $user;
                $activeUser=User::where('id', $user)->first();
                $contract->users()
                    ->attach(User::where('id', $user)->first());
                    $email = $activeUser->email;
                    $subject = "Asignación de contratos";
                    $message = "Se le ha asignado el contrato ". $request->name." para revisión";

                    Mail::to($email)->send(new SendEmail($subject, $message));
            }
            $contract->files()
                ->attach(File::where('id', $file_Name->id)->first());
        }
        /*$date = date('Y-m-d');
        $ano = substr($date, -10, 4);
        $mes = substr($date, -5, 2);
        $dia = substr($date, -2, 2);
        echo $ano;
        echo $mes ;
        echo $dia+5;
        echo $date;*/
    }
    }

