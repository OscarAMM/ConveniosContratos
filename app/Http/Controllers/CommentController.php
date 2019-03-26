<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $validate = $this->Validate($request,[
            'comment' => 'required',
        ]);
    }
}
