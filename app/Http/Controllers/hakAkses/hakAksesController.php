<?php

namespace App\Http\Controllers\hakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\menu;
use Session;
use DB;

class hakAksesController extends resourceController
{

    public function __construct(){
        if(!Session::get('login')){
            return back()->with('failed', 'Harap login terlebih dahulu');
        }
    }

    public function hakAkses(){
        $aplications = aplikasi::all();
        return view('hakAkses.requestHakAkses', ['aplications' => $aplications]);
    }
    public function allMenu($id, $idUser){
        $id = resourceController::dekripsi($id);
        $idUser = resourceController::dekripsi($idUser);
        $aplikasi = aplikasi::find($id)->aplikasi;
        $menus = DB::table('v_hak_akses')->where('user_id', $idUser)->where('aplikasi', $aplikasi)->get();
        
        return $menus;
    }

}
