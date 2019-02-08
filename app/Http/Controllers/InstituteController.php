<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute;

class InstituteController extends Controller
{
   public function index(){
       $institutions = Institute::orderBy('id','DESC')->paginate();
       return view('institutes.index', compact('institutions'));
   }
   public function show($id){
       $institutions = Institute::find($id);
       return view('institutes.show', compact('institutions'));
   }
}
