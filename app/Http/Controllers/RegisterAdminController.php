<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterAdminController extends Controller
{
        /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index(){
        return view("auth.registerAdmin");
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {   
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt( $request->input('password') );
            $user->save();
            $user
            ->roles()
            ->attach(Role::where('name', 'admin')->first());
            return redirect("/");
    }

    public function change_roles(Request $request)
    {
        $users = User::all();
        return view('change_roles', ['users' => $users]);
    }
    public function AdminAssignRoles(Request $request)
    {
        
        $user = User::where('email', $request['email'])->first();
        
        $user->roles()->detach();
        if ($request['role_user']) {
            DB::table('role_user')
            ->where('user_id',$request['id'] )
            ->update(['role_id' => 1]);
        }
        if ($request['role_admin']) {
            DB::table('role_user')
            ->where('user_id',$request['id'] )
            ->update(['role_id' => 2]);
        }
        return redirect("/");
    }
}
