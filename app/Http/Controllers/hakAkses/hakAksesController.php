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

        for ($i=0; $i < $request->nilai_hak_akses - 1; $i++) {
            $kalimatLihat = "lihat_" . $i;
            $kalimatUbah = "ubah_" . $i;
            $kalimatHapus = "hapus_" . $i;
            $kalimatTambah = "tambah_" . $i;

            $aksiLihat = explode('_', $request->$kalimatLihat);
            $aksiUbah = explode('_', $request->$kalimatUbah);
            $aksiHapus = explode('_', $request->$kalimatHapus);
            $aksiTambah = explode('_', $request->$kalimatTambah);
            // dd($request->$kalimatTambah);

            $idMenu = $aksiLihat[0];
            requestHakAplikasi::create([
                'id_request_head' => $head->id,
                'id_menu' => $idMenu,
                'tambah' => $aksiTambah[1],
                'lihat' => $aksiLihat[1],
                'ubah' => $aksiUbah[1],
                'hapus' => $aksiHapus[1],
            ]);
        }
        return back()->with('success', "Berhasil Meminta Hak Akses");
    }
}
