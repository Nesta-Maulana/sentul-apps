<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\utilityOnline\kategori;

class mainController extends Controller
{
    public function index(){
        return view('utilityOnline.index');
    }
    public function water(){
        return view("utilityOnline.water");
    }
    public function database(){
        return view("utilityOnline.database");
    }
    
}
