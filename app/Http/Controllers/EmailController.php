<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(){
        return view('mail.index');
    }
    public function sendEmail(Request $request){
        $this->validate($request,[
        "email" => "required",
        "subject" => "required",
        "message" => "required"]);
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        Mail::to($email)->send(new SendEmail($subject, $message));
    }
}
