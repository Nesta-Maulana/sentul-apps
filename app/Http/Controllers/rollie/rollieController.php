<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Http\Controllers\Controller;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\produk;
use DB;
use Session;

class rollieController extends resourceController
{
    private $menu;
    private $username;

    public function __construct(Request $request){
        $this->middleware(function ($request, $next)
        {
        $this->user = resolve('usersData');
        $this->username = karyawan::where('nik', $this->user->username)->first();            
        // $this->username =  $this->username->fullname;
        $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
        ->where('parent_id', '0')
        ->where('lihat', '1')
        ->where('aplikasi', 'Rollie')
        ->orderBy('posisi', 'asc')
        ->get();
        
        return $next($request);
        });
    }
    public function cpp()
    {
        $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
        $hakAksesAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
        
        if($hakAksesAplikasi == "1")
        {
            $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->first();
            $aplikasi = aplikasi::find($hakAksesUserAplikasi->id_aplikasi)->first();
            return redirect($aplikasi->link);
        }

        $i = 0;
        foreach ($hakAksesUserAplikasi as $h) 
        {
            $data[$i] = DB::table('aplikasi')->where('id', $h->id_aplikasi)->first();
            $i++;
        }
        $produk     = produk::where('status','!=','0')->pluck('nama_produk','id');
        $brix       = app('App\Http\Controllers\resourceController')->enkripsi('brix');
        $prisma     = app('App\Http\Controllers\resourceController')->enkripsi('prisma');
        return view('rollie.cpp',['brix'=>$brix,'prisma'=>$prisma,'menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'produk'=>$produk]);
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
