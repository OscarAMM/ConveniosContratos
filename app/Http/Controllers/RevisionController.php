<?php

namespace App\Http\Controllers;
use App\Contract;
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
}
