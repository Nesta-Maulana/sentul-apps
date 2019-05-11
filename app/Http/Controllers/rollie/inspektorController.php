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
use App\Models\productionData\kodeSampelPi;
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
        $kode_sampel        = kodeSampelPi::where('jenis_produk_id',$rpdfillinghead->wo[0]->produk->jenis_produk_id)->get();
        return view('rollie.inspektor.rpdfilling',['menus' => $this->menu,'username' => $this->username,'rpd_filling'=>$rpdfillinghead,'rpd_filling_aktif'=>$rpdfillingaktif,'kode_sampel'=>$kode_sampel]);	
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

    public function refreshTablePi($rpdfillingheadid)
    {
        $id                 = app('App\Http\Controllers\resourceController')->dekripsi($rpdfillingheadid);
        $rpdfillinghead     = rpdFillingHead::find($id);
        foreach ($rpdfillinghead->detail_pi as $detail_pi) 
        {
            foreach ($detail_pi->wo as $wo) 
            {
            }
            foreach ($detail_pi->mesin_filling as $mesin_filling) 
            {
            }
            foreach ($detail_pi->kode_sampel as $kode_sampel) 
            {
            }
        }
        foreach ($rpdfillinghead->detail_at_event as $detail_at_event) 
        {
            foreach ($detail_at_event->wo as $wo) 
            {
            }
            foreach ($detail_at_event->mesin_filling as $mesin_filling) 
            {
            }
            foreach ($detail_at_event->kode_sampel as $kode_sampel) 
            {
            }
        }
        return $rpdfillinghead;
    }
    public function tambahSampel(Request $request)
    {
        $wo_id           = app('App\Http\Controllers\resourceController')->dekripsi($request->nomor_wo);
        $mesin_filling_id   = app('App\Http\Controllers\resourceController')->dekripsi($request->mesin_filling_id);
        $tanggal_filling    = $request->tanggal_filling;
        $jam_filling        = $request->jam_filling;
        $kode_analisa_id    = app('App\Http\Controllers\resourceController')->dekripsi($request->kode_analisa_id);
        $keteranganevent    = $request->keteranganevent;
        $user_id_inputer    = app('App\Http\Controllers\resourceController')->dekripsi($request->user_inputer_id);
        $rpd_filling_head_id= app('App\Http\Controllers\resourceController')->dekripsi($request->rpd_filling_head_id);
        $berat_kanan        = $request->berat_kanan;
        $berat_kiri         = $request->berat_kiri;
        // pengecekan apa dia event atau tidak  
        switch ($keteranganevent)
        {
            case '0':
                // jika non event hanya PI aja 
                $insertPi       = rpdFillingDetailPi::create([
                    'rpd_filling_head_id'       => $rpd_filling_head_id,
                    'wo_id'                     => $wo_id,
                    'tanggal_filling'           => $tanggal_filling,
                    'jam_filling'               => $jam_filling,
                    'mesin_filling_id'          => $mesin_filling_id,
                    'kode_sampel_id'            => $kode_analisa_id,
                    'berat_kanan'               => $berat_kanan,
                    'berat_kiri'                => $berat_kiri,
                    'user_id_inputer'           => $user_id_inputer
                ]);
                return [ 'success'=>true,'message'=>'Permintaan Analisa Berhasil Diinput' ];
            break;
            case '1':
                // jika event maka akan input ke at event dan pi 
                $insertPi       = rpdFillingDetailPi::create([
                    'rpd_filling_head_id'       => $rpd_filling_head_id,
                    'wo_id'                     => $wo_id,
                    'tanggal_filling'           => $tanggal_filling,
                    'jam_filling'               => $jam_filling,
                    'mesin_filling_id'          => $mesin_filling_id,
                    'kode_sampel_id'            => $kode_analisa_id,
                    'berat_kanan'               => $berat_kanan,
                    'berat_kiri'                => $berat_kiri,
                    'user_id_inputer'           => $user_id_inputer
                ]);
                $insertPi       = rpdFillingDetailAtEvent::create([
                    'rpd_filling_head_id'       => $rpd_filling_head_id,
                    'wo_id'                     => $wo_id,
                    'tanggal_filling'           => $tanggal_filling,
                    'jam_filling'               => $jam_filling,
                    'mesin_filling_id'          => $mesin_filling_id,
                    'kode_sampel_id'            => $kode_analisa_id,
                    'user_id_inputer'           => $user_id_inputer
                ]);

                return [ 'success'=>true,'message'=>'Permintaan Analisa Berhasil Diinput' ];
            break;
        }
    }
}
