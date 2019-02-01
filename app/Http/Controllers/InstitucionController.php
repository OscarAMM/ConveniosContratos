<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    public function index(){
        $instituciones = Institucion::get();
        return view('instituciones.index');
    }
    public function create(){
        return view('instituciones.create');
    }
    
}
