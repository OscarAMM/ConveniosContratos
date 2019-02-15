<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dependence;

class DependenceController extends Controller
{
    public function index(){
        $dependence = Dependence::orderBy('id','ASC')->paginate();
        return view('dependencies.index', compact('dependence'));
    }
}
