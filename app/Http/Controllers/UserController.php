<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        $note=DB::table('usuarios')->insert(array(
            'nombre'=>$request->input('nombre')
        ));
        
        return redirect()->action('UserController@getregistro_suarios');
    }
    public function getSaveUser(){
        return view('registro_usuarios');
    }
}
