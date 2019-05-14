<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Comment;
use App\Contract;
use App\File;
use App\FileAgreement;
use App\Http\Requests\CommentRequest;

use App\User;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Mail\SendEmail;
use Session;
use Carbon\Carbon;

class CommentController extends Controller
{

    public function commentAgreement(CommentRequest $request, $id)
    {
        $user = \Auth::user();
        $agreement = Agreement::find($id);
        //Comentario
        $comment = new Comment();
        $comment->topic = $request->topic;
        $comment->comment = $request->comment;
        $comment->user = $user->name . " - " . $user->email;
        $comment->save();

        $file = $request->file('fileForum');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
            $file_Name = new FileAgreement();
            $file_Name->name = $file_path;
            $file_Name->save();
            $agreement->files()
            ->attach(FileAgreement::where('id', $file_Name->id)->first());
            $comment->filesAgreements()
                ->attach(FileAgreement::where('id', $file_Name->id)->first());
        } 
        

        

        $agreement->comments()
            ->attach(Comment::where('id', $comment->id)->first());
        
        foreach ($agreement->getUser as $users) {
            if ($users->email == $user->email) {
                $email = $user->email;
                $subject = "Nuevo comentario";
                $message = "Haz realizado un nuevo comentario al convenio: " . $agreement->name;
                Mail::to($email)->send(new SendEmail($subject, $message));
            } else {
                $email = $users->email;
                $subject = "Nuevo comentario";
                $message = "Se ha realizado un nuevo comentario al convenio: " . $agreement->name . " por el usuario: " . $user->name . " - " . $user->email;
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
        }
        return redirect()->route('Forum.Agreement', $id)->with('info', 'Tu comentario ha sido generado con éxito');
    }
    public function commentContract(CommentRequest $request, $id)
    {
        $user = \Auth::user();
        $contract = Contract::find($id);
        //Comentario
        $comment = new Comment();
        $comment->topic = $request->topic;
        $comment->comment = $request->comment;
        $comment->user = $user->name . " - " . $user->email;
        $comment->save();

        $file = $request->file('fileForum');
        if ($file) {
            $file_path = $file->getClientOriginalName();
            \Storage::disk('public')->put('files/' . $file_path, \File::get($file));
            //Archivo
            $file_Name = new File();
            $file_Name->name = $file_path;
            $file_Name->save();
            $contract->files()
            ->attach(File::where('id', $file_Name->id)->first());
            $comment->filesContracts()
            ->attach(File::where('id', $file_Name->id)->first());
        }

        $contract->comments()
            ->attach(Comment::where('id', $comment->id)->first());
        
        foreach ($contract->getUser as $users) {
            if ($users->email == $user->email) {
                $email = $user->email;
                $subject = "Nuevo comentario";
                $message = "Haz realizado un nuevo comentario al contrato: " . $contract->name;
                Mail::to($email)->send(new SendEmail($subject, $message));
            } else {
                $email = $users->email;
                $subject = "Nuevo comentario";
                $message = "Se ha realizado un nuevo comentario al contrato: " . $contract->name . " por el usuario: " . $user->name . " - " . $user->email;
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
        }
        return redirect()->route('Forum.Contract', $id)->with('info', 'Tu comentario ha sido generado con éxito');
    }
    public function finallyAgreement($id)
    {
        $agreement = Agreement::find($id);
        $agreement->status = "Finalizado";
        $agreement->update();
        $user = User::find($agreement->liable_user);
        $email = $user->email;
        $subject = "Convenio finalizado";
        $message = "El convenio: " . $agreement->name . " ya termino su periodo de revisión. Puede acceder a el ingresando al sistema SICC.";
        Mail::to($email)->send(new SendEmail($subject, $message));
        return redirect()->route('Revision', $id)->with('info', 'El convenio '. $agreement->name.' ha sido finalizado con éxito');
        

    }
    public function finallyContract($id)
    {
        $contract = Contract::find($id);
        $contract->status = "Finalizado";
        $contract->update();
        $user = User::find($contract->liable_user);
        $email = $user->email;
        $subject = "Contrato finalizado";
        $message = "El contrato: " . $contract->name . " ya termino su periodo de revisión. Puede acceder a el ingresando al sistema SICC.";
        Mail::to($email)->send(new SendEmail($subject, $message));
        return redirect()->route('Revision', $id)->with('info', 'El contrato '.$contract->name.' ha sido finalizado con éxito');

    }
    public function notifyAgreement($id){
        $agreement = Agreement::find($id);
        $value =null;
        foreach($agreement->getUser as $user){
            foreach($agreement->getComments as $comment){
                $value = ends_with($comment->user,$user->email );
            }
            if(!$value){
                $dt= Carbon::now()->subDays(1)->diffForHumans($agreement->end_date);
                        
                $email = $user->email;
                $subject = "Recordatorio de revisión";
                if($value = ends_with($dt, 'antes')){
                    $message = "Buen día, se le informa que no ha realizado la revisión correspondiente al convenio: " . $agreement->name.", por lo que se le recuerda que el tiempo con el que dispone es de ". $dt." de concluir el periodo de revisión.";
                }
                if($value = ends_with($dt, 'después')){
                    $message = "Buen día, se le informa que no ha realizado la revisión correspondiente al convenio: " . $agreement->name.", por lo que se le recuerda que el tiempo transcurrido es de ". $dt." de haber concluido el periodo de revisión.";
                }
                Mail::to($email)->send(new SendEmail($subject, $message));

            }
        }
        return redirect()->route('Forum.Agreement', $id)->with('info', 'Haz notificado a los usuarios con éxito');

    }
    public function notifyContract($id){
        $contract = Contract::find($id);
        $value =null;
        foreach($contract->getUser as $user){
            foreach($contract->getComments as $comment){
                $value = ends_with($comment->user,$user->email );
            }
            if(!$value){
                $dt= Carbon::now()->subDays(1)->diffForHumans($contract->end_date);
                        
                $email = $user->email;
                $subject = "Recordatorio de revisión";
                if($value = ends_with($dt, 'antes')){
                    $message = "Buen día, se le informa que no ha realizado la revisión correspondiente al contrato: " . $contract->name.", por lo que se le recuerda que el tiempo con el que dispone es de ". $dt." de concluir el periodo de revisión.";
                }
                if($value = ends_with($dt, 'después')){
                    $message = "Buen día, se le informa que no ha realizado la revisión correspondiente al contrato: " . $contract->name.", por lo que se le recuerda que el tiempo transcurrido es de ". $dt." de haber concluido el periodo de revisión.";
                }
                Mail::to($email)->send(new SendEmail($subject, $message));

            }
        }
        return redirect()->route('Forum.Contract', $id)->with('info', 'Haz notificado a los usuarios con éxito');

    }
}
