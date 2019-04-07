<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $name  =$request->get('name');
        $email =$request->get('email');
        $id    =$request->get('id');

        $users = User::orderBy('id','ASC')
        ->name($name)
        ->email($email)
        ->id($id)
        ->paginate();
        return view('auth.index', compact('users'));

    }
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
        return view('auth.show_users', ['user' => $user],['rol'=>$rol]);
    }
    public function edit(String $id){
        $user = User::where('id', $id)->first();
        
        return view('auth.editUSer', ['user' => $user]);
    }
    public function edited(Request $request,String $id){
        $user = User::where('id', $request['id'])->first();
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->update();
        $user->roles()->detach();
        if ($request['rol']=="user") {
            $user->roles()->attach(Role::where('name', 'user')->first());
        }
        if ($request['rol']=="admin") {
            $user->roles()->attach(Role::where('name', 'admin')->first());
        }
        //return back()->with('info','El usuario ha sido editado');
        return redirect()->back()->with('info','El usuario '.$user->name.' ha sido editado');
    }
    public function destroy(String $id){
        $user=User::find($id);
        $user->roles()->detach();
        $user->delete();
        return back()->with('info','El usuario ha sido eliminado');
        //return redirect()->back();
    }
}
