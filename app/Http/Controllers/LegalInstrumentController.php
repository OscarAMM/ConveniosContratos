<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalInstrumentController extends Controller
{
    public function index(){
        return view ('instrument.index');
    }
    public function create(){
        return view ('instrument.create');
    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
