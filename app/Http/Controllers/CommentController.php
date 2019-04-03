<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Comment;
use App\Http\Requests\CommentRequest;
use App\User;

class CommentController extends Controller
{

    public function commentAgreement(CommentRequest $request, $id)
    {
        //$user=User::find($idUser);
        $user = \Auth::user();
        $agreement = Agreement::find($id);

        /*$file = $request->file('fileForum');
        if ($file) {
        $file_path = $file->getClientOriginalName();
        \Storage::disk('public')->put('filesAgreements/' . $file_path, \File::get($file));
        } else {
        return back()->with('info', 'No selecciono un archivo.');
        }
        //Archivo
        $file_Name = new FileAgreement();
        $file_Name->name = $file_path;
        $file_Name->save();*/

        //Comentario
        $comment = new Comment();
        $comment->topic = $request->topic;
        $comment->comment = $request->comment;
        $comment->user = $user->name . " - " . $user->email;
        $comment->save();

        $agreement->comments()
            ->attach(Comment::where('id', $comment->id)->first());
        /*$agreement->files()
        ->attach(FileAgreement::where('id', $file_Name->id)->first());*/
        return redirect()->route('Forum.Agreement', $id)->with('info', 'Tu comentario ha sido generado con éxito');

    }
}
