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
use App\Models\masterApps\brand;
use App\Models\productionData\wo;
use App\Models\productionData\rpdFillingHead;
use App\Models\productionData\rpdFillingDetailPi;
use App\Models\productionData\rpdFillingDetailAtEvent;
use DB;
use Session;

class inspektorController extends resourceController
{
		private $menu;
    private $username;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            // $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'Rollie - Inspektor QC')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

    public function index()
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
        
        // mengambil jadwal wo diminggu ini saja dan wo yang statusnya WIP Filling di minggu-minggu sebelumnya 
        $wos        = wo::where('status','3')->orWhere('status','2')->whereNotIn('produk_id',['30','31','32'])->get();
        
        $cekyobase  = wo::where('status','3')->orWhere('status','2')->whereIn('produk_id',['30','31','32'])->get();
        return view('rollie.inspektor.dashboard',['menus' => $this->menu,'username' => $this->username, 'hakAkses' => $data,'wos'=>$wos]);
    }
    public function rpdfilling($rpdfillingheadid)
    {
        $id                 = app('App\Http\Controllers\resourceController')->dekripsi($rpdfillingheadid);
        $rpdfillinghead     = rpdFillingHead::find($id);
        $rpdfillingaktif    = rpdFillingHead::where('status','1')->get();
        return view('rollie.inspektor.rpdfilling',['menus' => $this->menu,'username' => $this->username,'rpd_filling'=>$rpdfillinghead,'rpd_filling_aktif'=>$rpdfillingaktif]);
    	
    }
    public function prosesrpdfilling(Request $request)
    {    
        $produk                 = produk::where('nama_produk',$request->nama_produk)->first();
        $produk_id              = $produk->id;
        $startfilling           = date('Y-m-d');
        //insert ke head table rpd filling
        $insertrpdfillinghead   = rpdFillingHead::create([
                                'produk_id'     =>$produk_id,
                                'start_filling' =>$startfilling,
                                'status'        =>'1'    
                                ]);
        //update data wo ubah status dan ubah tanggal fillpack sesuai dengan start filling hari ini. 
        $datawo                     = wo::where('nomor_wo',$request->nomor_wo)->first();
        $datawo                     = wo::find($datawo->id);
        $datawo->status             = '3';
        $datawo->tanggal_fillpack   = $startfilling;
        $datawo->save();
        $return                     = app('App\Http\Controllers\resourceController')->enkripsi($insertrpdfillinghead->id);
        return ['id_rpd_head'=>$return];

        
    }
}
