<?php

namespace App\Http\Controllers;
use App\File;
use App\FileAgreement;
use App\Agreement;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function showRevision()
    {
        return view('agreements.revision');
    }
    public function back()
    {
        return redirect()->back();
    }    
    
    public function ForumAgreement($id){
        $agreements = Agreement::find($id);
        return view('agreements.forum', compact('agreements'));
    }
    public function UserRevision(){
        return view('public.UserRevision');
    }
    public function PublicForumAgreement($id){

        $agreements = Agreement::find($id);
        $files = $agreements->getFiles;
        $list = array($files);
        $cont = count($files);
        $idFile=last($list)[$cont - 1]->id;
        $file=FileAgreement::find($idFile);
        return view('public.agreementforum', compact('agreements','file'));
    }
}
