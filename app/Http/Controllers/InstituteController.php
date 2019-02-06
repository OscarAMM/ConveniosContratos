<?php

namespace App\Http\Controllers;
use App\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    //Accion para generar vista index de Instituto/Dependencias
    public function index(){
        return view('Institutes.indexInstitute');
    }
   public function registerInstitute(){
        return view('Institutes.CreateInstitute');
    }


     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'siglas' => ['required', 'string', 'max:10'],
            'pais' => ['required', 'string', 'max:100'],
        ]);
    }
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Institute
     */
    protected function create(Request $request)
    { 
            $institute = new Institute;
            $institute->nombre = $request->input('nombre');
            $institute->siglas = $request->input('siglas');
            $institute->pais = $request->input('pais');
            $institute->save();
            return redirect()->action('InstituteController@index');
    }

   protected function consult(){
       $institutes = \DB::table('instituciones') ->select('nombre','pais')->get();
       return view ("Institutes.Consult", compact('institutes'));
   }

}
