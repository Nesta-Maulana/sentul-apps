<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\productionData\wo;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Http\Controllers\Controller;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\produk;
use App\Models\productionData\cppHead;
use App\Models\productionData\cppDetail;
use App\Models\productionData\palet;
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
        $urlfullnya     = url()->full();
        $aplikasinya    = explode($_SERVER['HTTP_HOST']."/sentul-apps" , $urlfullnya)       ;
        $aplikasinya    = explode('/',$aplikasinya[1]);
        $aplikasiid     = aplikasi::where('link',$aplikasinya[1])->first();
        $aplikasiid     = $aplikasiid->id;
        if($hakAksesAplikasi == "1")
        {
            $cekakses = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->first();
            if ($aplikasiid !==  $cekakses->id_aplikasi) 
            {
                $aplikasi = aplikasi::find($cekakses->id_aplikasi);
                // dd($aplikasi);
                return redirect($aplikasi->link);
            }
            
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
    public function analisaKimia()
    {
        $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
        $hakAksesAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
        
        if($hakAksesAplikasi == "1")
        {
            $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->first();
            $aplikasi = aplikasi::find($hakAksesUserAplikasi->id_aplikasi)->first();
            return redirect($aplikasi->link);
        }
        $listcpp       = cppHead::all();

        $i = 0;
        foreach ($hakAksesUserAplikasi as $h) 
        {
            $data[$i] = DB::table('aplikasi')->where('id', $h->id_aplikasi)->first();
            $i++;
        }
        $produk     = produk::where('status','!=','0')->get();
        $wo         = wo::all();
        return view('rollie.analisa_kimia',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$listcpp,'produks'=>$produk,'wo'=>$wo]);
    }
    public function analisaKimiaAnalisa($id_cpp_head)
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
        $cpps       = cppHead::find(resourceController::dekripsi($id_cpp_head));
        return view('rollie.analisa_kimia_analisa',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$cpps]);
        // return view('');
    }
    public function rkj()
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
        return view('rollie.rkj',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
        // return view('rollie.rkj');
    }
    public function rkjInput(){

        
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
        return view('rollie.rkjInput',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
        // return view('');
    }
    public function packageIntegrity()
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
        return view('rollie.packageIntegrity',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
        // return view('rollie.packageIntegrity');
    }
    public function ppq(){
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
        return view('rollie.ppq',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
    }
    public function analisaMikro(){

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
        return view('rollie.analisaMikro',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
        // return view('rollie.analisaMikro');
    }
    public function sortasi(){

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
        return view('rollie.sortasi',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
        // return view('');
    }
    public function rpr(){

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
        $wos        = wo::where('status','<>','6')->get();        
        return view('rollie.rpr',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'wos'=>$wos]);
        // return view('');
    }
    public function report()
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
        return view('rollie.report',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
        // return view('');
    }
}
