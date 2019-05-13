<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\UserRequest;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);
        return view('home');
    }
    public function requestUser(UserRequest $request){
        $name = $request->get('name');
        return view('home', compact('name'));
    }
    
}
