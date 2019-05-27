<?php

namespace App\Http\Controllers\goOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class goOfficeController extends Controller
{
    public function index(){
        return view('goOffice.index');
    }
}
