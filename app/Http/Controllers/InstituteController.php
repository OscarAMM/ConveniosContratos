<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute;

class InstituteController extends Controller
{
   public function index(){
       $institutions = Institute::orderBy('id','ASC')->paginate();
       return view('institutes.index', compact('institutions'));
   }
   public function show($id){
       $institutions = Institute::find($id);
       return view('institutes.show', compact('institutions'));
   }
   public function destroy($id){
        $institutions = Institute::find($id);
        $institutions->delete();

        return back()->with('info','La institucion ha sido eliminada');
   }
   public function create(){
        return view('institutes.create');
   }
   public function edit($id){
    $institute = Institute::find($id);
    return view('institutes.edit', compact('institute'));
   }
}
