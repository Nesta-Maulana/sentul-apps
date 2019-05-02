<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class utilityOnlineController extends Controller
{
    public function userGuide(){
        return view('utilityOnline.userGuide');
    }
}
