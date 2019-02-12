<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
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
    public function show(String $id)
    {
        $user = User::where('id', $id)->first();
        $rol= $user->roles()->first()->name;
        return view('show_users', ['user' => $user],['rol'=>$rol]);
    }
    public function edit(String $id){
        $user = User::where('id', $id)->first();
        return view('auth.editUSer', ['user' => $user]);
    }
    public function edited(Request $request,String $id){
        $user = User::where('id', $request['id'])->first();
        $user->roles()->detach();
        if ($request['rol']=="user") {
            $user->roles()->attach(Role::where('name', 'user')->first());
        }
        if ($request['rol']=="admin") {
            $user->roles()->attach(Role::where('name', 'admin')->first());
        }
        return redirect()->back();
    }
    public function destroy(String $id){
        $user=User::find($id);
        $user->roles()->detach();
        $user->delete();
        return redirect()->back();
    }
}
