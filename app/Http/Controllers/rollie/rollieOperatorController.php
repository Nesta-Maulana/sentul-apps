<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class rollieOperatorController extends Controller
{
    public function cpp(){
        return view('rollie.operator.dashboard');
        // return view('rollie.operator.cpp');
    }
}
