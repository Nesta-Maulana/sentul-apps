<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class rollieController extends Controller
{
    public function cpp(){
        return view('rollie.cpp');
    }
}
