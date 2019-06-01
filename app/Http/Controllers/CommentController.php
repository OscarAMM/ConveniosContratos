<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Comment;
use App\File;
use App\FileAgreement;
use App\Http\Requests\CommentRequest;
use App\User;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Mail\SendEmail;
use Session;
use Carbon\Carbon;
    
use Illuminate\Support\Collection;

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
        $comment->status=$agreement->status;
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
                $message = "Haz realizado un nuevo comentario al documento: " . $agreement->name;
                Mail::to($email)->send(new SendEmail($subject, $message));
            } else {
                $email = $users->email;
                $subject = "Nuevo comentario";
                $message = "Se ha realizado un nuevo comentario al documento: " . $agreement->name . " por el usuario: " . $user->name . " - " . $user->email;
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
        }
        return redirect()->route('Forum.Agreement', $id)->with('info', 'Tu comentario ha sido generado con éxito');
    }
    public function finallyAgreement($id)
    {
        $agreement = Agreement::find($id);
        $agreement->status = "Entregado";
        $agreement->update();
        foreach ($agreement->getUser as $users) {
            $email = $users->email;
            $subject = "Documento Entregado";
            $message = "El documento: " . $agreement->name . " ya termino su periodo de revisión. Puede acceder a el ingresando al sistema SICC.";
            Mail::to($email)->send(new SendEmail($subject, $message));
        }
        return redirect()->route('Revision', $id)->with('info', 'El documento '. $agreement->name.' ha sido finalizado con éxito');
    }
    
    public function notifyAgreement($id)
    {
        $agreement = Agreement::find($id);
        $value =null;
        $messageAdmin=null;
        $usersNotified=new Collection();
        foreach ($agreement->getUser as $user) {
            foreach ($agreement->getComments as $comment) {
                $value = ends_with($comment->user, $user->email);
            }
            if (!$value) {
                $dt= Carbon::now()->subDays(1)->diffForHumans($agreement->end_date);
                        
                $email = $user->email;
                $usersNotified->push($user->name.' - '.$user->email);
                $subject = "Recordatorio de revisión";
                if ($value = ends_with($dt, 'antes')) {
                    $message = "Buen día, se le informa que no ha realizado la revisión correspondiente al documento: " . $agreement->name.", por lo que se le recuerda que el tiempo con el que dispone es de ". $dt." de concluir el periodo de revisión.";
                    $messageAdmin="Buen día, se le informa que el tiempo con el que dispone el documento ".$agreement->name." es de ". $dt." de concluir el periodo de revisión.";
                }
                if ($value = ends_with($dt, 'después')) {
                    $message = "Buen día, se le informa que no ha realizado la revisión correspondiente al documento: " . $agreement->name.", por lo que se le recuerda que el tiempo transcurrido es de ". $dt." de haber concluido el periodo de revisión.";
                    $messageAdmin="Buen día, se le informa que el tiempo transcurrido del documento ".$agreement->name." es de ". $dt." de haber concluido el periodo de revisión.";
                }
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
        }
        foreach ($agreement->getUser as $admin) {
            if ($admin->hasRole('admin')) {
                $email = $admin->email;
                $subject = "Usuarios sin revisar el documento ".$agreement->name;
                $message=$messageAdmin.'  Los siguientes usuarios no han realizado la revisión correspondiente: '.$usersNotified;
                Mail::to($email)->send(new SendEmail($subject, $message));
            }
        }   
        return redirect()->route('Forum.Agreement', $id)->with('info', 'Haz notificado a los usuarios con éxito');
    }
}
