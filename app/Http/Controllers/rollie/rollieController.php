<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class rollieController extends Controller
{
    public function cpp(){
        return view('rollie.cpp');
    }
    public function analisaKimia(){
        return view('rollie.analisa_kimia');
    }
    public function analisaKimiaAnalisa(){
        return view('rollie.analisa_kimia_analisa');
    }
    public function rkj(){
        return view('rollie.rkj');
    }
    public function rkjInput(){
        return view('rollie.rkjInput');
    }
    public function packageIntegrity(){
        return view('rollie.packageIntegrity');
    }
    public function ppq(){
        return view('rollie.ppq');
    }
    public function analisaMikro(){
        return view('rollie.analisaMikro');
    }
    public function sortasi(){
        return view('rollie.sortasi');
    }
    public function rpr(){
        return view('rollie.rpr');
    }
    public function report(){
        return view('rollie.report');
    }
}
