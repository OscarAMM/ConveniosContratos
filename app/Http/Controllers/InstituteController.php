<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstituteController extends Controller
{
    //Accion para generar vista
    public function index(){
        return view('Institutes.index');
    }
}
