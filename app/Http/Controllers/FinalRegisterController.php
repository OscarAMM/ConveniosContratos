<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreement;

class FinalRegisterController extends Controller
{
    public function index($id){
        $agreement=Agreement::find($id);
        return view('finalRegister.index',compact('agreement'));
    }
}
