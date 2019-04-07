<?php

namespace App\Http\Controllers;
use App\Contract;
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
    public function ForumAgreement($id){
        $agreements = Agreement::find($id);
        return view('agreements.forum', compact('agreements'));
    }
    public function ForumContract($id){
        $contracts = Contract::find($id);
        return view('contracts.forum',compact('contracts'));
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
    public function PublicForumContract($id){
        $contracts = Contract::find($id);
        $files = $contracts->getFiles;
        $list = array($files);
        $cont = count($files);
        $idFile=last($list)[$cont - 1]->id;
        $file=File::find($idFile);
        return view('public.contractforum',compact('contracts','file'));
    }
}
