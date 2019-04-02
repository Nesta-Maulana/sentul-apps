<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class adminUtilityController extends Controller
{
    public function index(){
        return view('utilityOnline.admin.index');
    }
}
