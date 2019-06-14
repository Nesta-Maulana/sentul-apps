<?php

namespace App\Http\Controllers\hakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\requestHakAplikasi;
use App\Models\masterApps\requestHakAplikasiHead;
use App\Models\masterApps\menu;
use Session;
use DB;

class hakAksesController extends resourceController
{


    public function hakAkses(){

        if(!Session::get('login')){
            return back()->with('failed', 'Harap login terlebih dahulu');
        }
        $aplications = aplikasi::all();
        return view('hakAkses.requestHakAkses', ['aplications' => $aplications]);
    }
    public function allMenu($id, $idUser){
        if(!Session::get('login')){
            return back()->with('failed', 'Harap login terlebih dahulu');
        }
        $id = resourceController::dekripsi($id);
        $idUser = resourceController::dekripsi($idUser);
        $aplikasi = aplikasi::find($id)->aplikasi;
        $menus = DB::table('v_hak_akses')->where('user_id', $idUser)->where('aplikasi', $aplikasi)->get();
        
        return $menus;
    }
    public function requestHakAkses(Request $request){
        
        if(!Session::get('login')){
            return back()->with('failed', 'Harap login terlebih dahulu');
        }
        $id = resourceController::dekripsi($request->aplikasi);
        $head = requestHakAplikasiHead::create([
            'id_aplikasi' => $id,
            'id_user_request' => Session::get('login'),
        ]);
        $menus = menu::all();
        foreach ($menus as $menu) {
            if($request['lihat_' . $menu->id] == '1'){
                requestHakAplikasi::create([
                    'id_request_head' => $head->id,
                    'id_menu' => $menu->id,
                    'aksi' => 'lihat'
                ]);
            }
            if($request['ubah_' . $menu->id] == '1'){
                requestHakAplikasi::create([
                    'id_request_head' => $head->id,
                    'id_menu' => $menu->id,
                    'aksi' => 'ubah'
                ]);
            }
            if($request['hapus_' . $menu->id] == '1'){
                requestHakAplikasi::create([
                    'id_request_head' => $head->id,
                    'id_menu' => $menu->id,
                    'aksi' => 'hapus'
                ]);
            }
            if($request['tambah_' . $menu->id] == '1'){
                requestHakAplikasi::create([
                    'id_request_head' => $head->id,
                    'id_menu' => $menu->id,
                    'aksi' => 'tambah'
                ]);
            }
        }
        
        return back()->with('success', "Berhasil Meminta Hak Akses");
    }
}
