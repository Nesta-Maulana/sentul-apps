<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class rollieController extends Controller
{
    public function cpp(){
        // $a = DB::table('users')->get();

        // $n = 0;
        // $m = 0;
        // $v = 0;
        // $z = 0;
        // foreach ($a as $b) {
        //     $timestamp = strtotime($b->created_at);
        //     $month = date('m', $timestamp);
        //     if($n < "1"){
        //         if($month == "01"){
        //             echo "Januari <br>";
        //             $n++;
        //         }
        //     }
        //     if($m < "1"){
        //         if($month == "02"){
        //             echo "Februari <br>";
        //             $m++;
        //         }
        //     }
        //     if($v < "1"){
        //         if($month == "03"){
        //             echo "Maret <br>";
        //             $v++;
        //         }
        //     }
        //     if($z < "1"){
        //         if($month == "04"){
        //             echo "April <br>";
        //             $v++;
        //         }
        //     }
        // }
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
}
