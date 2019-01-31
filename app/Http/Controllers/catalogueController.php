<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class catalogueController extends Controller
{
   public function index(){
       return view ('catalogue.index');
   }
}
