<?php

use App\Contract;
use App\Http\Requests\ContractRequest;

namespace App\Http\Controllers;

class ContractController extends Controller
{
    public function index()
    {
        return view('contracts.index');
    }
}
