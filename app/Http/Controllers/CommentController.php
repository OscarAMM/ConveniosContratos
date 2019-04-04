<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Contract;
use App\FileAgreement;
use App\File;
use App\Comment;
use App\Http\Requests\CommentRequest;
use App\User;
use Mail;
use Session;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Storage;


class CommentController extends Controller
{

    public function commentAgreement(CommentRequest $request, $id)
    {
        $user = \Auth::user();
        $agreement = Agreement::find($id);

        $file = $request->file('fileForum');
        if ($file) {
        $file_path = $file->getClientOriginalName();
        \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
        } else {
        return back()->with('info', 'No selecciono un archivo.');
        }
        //Archivo
        $file_Name = new FileAgreement();
        $file_Name->name = $file_path;
        $file_Name->save();

        //Comentario
        $comment = new Comment();
        $comment->topic = $request->topic;
        $comment->comment = $request->comment;
        $comment->user = $user->name . " - " . $user->email;
        $comment->save();

        $agreement->comments()
            ->attach(Comment::where('id', $comment->id)->first());
        $agreement->files()
        ->attach(FileAgreement::where('id', $file_Name->id)->first());
        $comment->filesAgreements()
        ->attach(FileAgreement::where('id', $file_Name->id)->first());
        foreach ($agreement->getUser as $users) {
                if($users->email==$user->email){
                    $email = $user->email;
                    $subject = "Nuevo comentario";
                    $message = "Haz realizado un nuevo comentario al convenio: ". $agreement->name;
                    Mail::to($email)->send(new SendEmail($subject, $message));
                }else{
                    $email = $users->email;
                    $subject = "Nuevo comentario";
                    $message = "Se ha realizado un nuevo comentario al convenio: ". $agreement->name." por el usuario: ".$user->name." - ".$user->email;
                    Mail::to($email)->send(new SendEmail($subject, $message));
                }
        }
        return redirect()->route('Forum.Agreement', $id)->with('info', 'Tu comentario ha sido generado con éxito');
    }
    public function commentContract(CommentRequest $request, $id)
    {
        $user = \Auth::user();
        $contract = Contract::find($id);

        $file = $request->file('fileForum');
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

        //Comentario
        $comment = new Comment();
        $comment->topic = $request->topic;
        $comment->comment = $request->comment;
        $comment->user = $user->name . " - " . $user->email;
        $comment->save();

        $contract->comments()
            ->attach(Comment::where('id', $comment->id)->first());
        $contract->files()
        ->attach(File::where('id', $file_Name->id)->first());
        $comment->filesContracts()
        ->attach(File::where('id', $file_Name->id)->first());
        foreach ($contract->getUser as $users) {
            if($users->email==$user->email){
                $email = $user->email;
                $subject = "Nuevo comentario";
                $message = "Haz realizado un nuevo comentario al contrato: ". $contract->name;
                Mail::to($email)->send(new SendEmail($subject, $message));
            }else{
                $email = $users->email;
                $subject = "Nuevo comentario";
                $message = "Se ha realizado un nuevo comentario al contrato: ". $contract->name." por el usuario: ".$user->name." - ".$user->email;
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
    }
        return redirect()->route('Forum.Contract', $id)->with('info', 'Tu comentario ha sido generado con éxito');
    }
    public function finallyAgreement($id){
        $agreement=Agreement::find($id);
        $agreement->status="finalizado";
        $agreement->update();
        $user=User::find($agreement->liable_user);
                $email = $user->email;
                $subject = "Convenio finalizado";
                $message = "El convenio: ". $agreement->name." ya termino su periodo de revisión. Puede acceder a el ingresando al sistema SICC.";
                Mail::to($email)->send(new SendEmail($subject, $message));

    }
    public function finallyContract($id){
        $contract=Contract::find($id);
        $contract->status="finalizado";
        $contract->update();
        $user=User::find($contract->liable_user);
                $email = $user->email;
                $subject = "Contrato finalizado";
                $message = "El contrato: ". $contract->name." ya termino su periodo de revisión. Puede acceder a el ingresando al sistema SICC.";
                Mail::to($email)->send(new SendEmail($subject, $message));

    }
}
