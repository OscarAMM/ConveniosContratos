<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    public function index(){
        $instituciones = Institucion::get();
        return view('institute.index');
    }
    public function create(){
        return view('institute.create');
    }
    
}
