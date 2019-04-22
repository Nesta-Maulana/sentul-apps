<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class penyeliaController extends Controller
{
    public function mtol(){
        return view('rollie.penyelia.mtol');
    }
}
