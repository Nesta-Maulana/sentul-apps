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
use App\Models\masterApps\mesinFilling;
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
        $detailnya      = array(); 
        foreach ($rpdfillinghead->detail_pi as $key => $value) 
        {
           if (is_null($value->airgap) && is_null($value->ts_accurate_kanan) && is_null($value->ts_accurate_kiri) && is_null($value->ls_accurate) && is_null($value->sa_accurate) && is_null($value->surface_check) && is_null($value->pinching) && is_null($value->strip_folding) && is_null($value->konduktivity_kanan) && is_null($value->konduktivity_kiri) && is_null($value->design_kanan) && is_null($value->design_kiri) && is_null($value->dye_test) && is_null($value->residu_h2o2) && is_null($value->prod_code_no_md) && is_null($value->correction)) 
           {
                 $detail_pi_nya  = [
                'kode_sampel'           =>$value->kode_sampel->kode_sampel,
                'event'                 => ucwords($value->kode_sampel->event),
                'mesin_filling'         => $value->mesin_filling->kode_mesin,
                'tanggal_filling'       => $value->tanggal_filling,
                'jam_filling'           => $value->jam_filling,
                'detail_id'             => $value->id,
                'detail_id_enkripsi'             => app('App\Http\Controllers\resourceController')->enkripsi($value->id),
                'nama_produk'           => $value->wo->produk->nama_produk,
                'wo_id'                 => app('App\Http\Controllers\resourceController')->enkripsi($value->wo->id),
                'nomor_wo'              => $value->wo->nomor_wo,
                'order'                 => $value->tanggal_filling.' '.$value->jam_filling,
                'kodenya'               => 'Bukan Event',
                'mesin_filling_id'      => app('App\Http\Controllers\resourceController')->enkripsi($value->mesin_filling->id)
                ];
                array_push($detailnya, $detail_pi_nya);
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
        
        foreach ($rpdfillinghead->detail_at_event as $key => $value) 
        {
            if ($value->ls_sa_sealing_quality !== null && $value->ls_sa_sealing_quality !== '' && $value->ls_sa_proportion !== null && $value->ls_sa_proportion !== '' && $value->status_akhir !== null && $value->status_akhir !== '') 
            {
                $detail_pi_nya  = [
                'detail_id'             => $value->id,
                'nomor_wo'              => $value->wo->nomor_wo,
                'tanggal_filling'       => $value->tanggal_filling,
                'jam_filling'           => $value->jam_filling,
                'kode_sampel'           => $value->kode_sampel->kode_sampel.' (Event)',
                'kodenya'               => 'Event',
                'event'                 => $value->kode_sampel->event,
                'order'                 => $value->tanggal_filling.' '.$value->jam_filling,
                'mesin_filling'         => $value->mesin_filling->kode_mesin
                ];
                array_push($detailnya, $detail_pi_nya);
            }   
        }        
        unset($rpdfillinghead->detail_pi);
        unset($rpdfillinghead->detail_at_event);
        $detailnya = $this->array_orderby($detailnya,'order',SORT_ASC);

        $rpdfillinghead->detail_pi_nya = $detailnya;

        return $rpdfillinghead;
    }

    function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
                }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
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

    public function analisaSampelPi(Request $request)
    {

        $rpd_filling_detail_id_pi           = app('App\Http\Controllers\resourceController')->dekripsi($request->rpd_filling_detail_id_pi);
        $rpd_filling_head_id                = app('App\Http\Controllers\resourceController')->dekripsi($request->rpd_filling_head_id);
        $wo_id                              = app('App\Http\Controllers\resourceController')->dekripsi($request->wo_id);
        $mesin_filling_id                   = app('App\Http\Controllers\resourceController')->dekripsi($request->mesin_filling_id);
        $nama_produk_analisa_pi             = $request->nama_produk_analisa_pi;
        $airgap                             = $request->air_gap;
        $ts_accurate_kanan                  = $request->ts_accurate_kanan;
        $ts_accurate_kiri                   = $request->ts_accurate_kiri;
        $ls_accurate                        = $request->ls_accurate;
        $sa_accurate                        = $request->sa_accurate;
        $surface_check                      = $request->surface_check;
        $pinching                           = $request->pinching;
        $strip_folding                      = $request->strip_folding;
        $konduktivity_kanan                 = $request->konduktivity_kanan;
        $konduktivity_kiri                  = $request->konduktivity_kiri;
        $design_kanan                       = $request->design_kanan;
        $design_kiri                        = $request->design_kiri;
        $dye_test                           = $request->dye_test;
        $residu_h2o2                        = $request->residu_h2o2;
        $prod_code_no_md                    = $request->prod_code_no_md;
        $correction                         = $request->correction;
        $ts_accurate_kanan_tidak_ok         = $request->ts_accurate_kanan_tidak_ok;
        $ts_accurate_kiri_tidak_ok          = $request->ts_accurate_kiri_tidak_ok;
        $ls_accurate_tidak_ok               = $request->ls_accurate_tidak_ok;
        $sa_accurate_tidak_ok               = $request->sa_accurate_tidak_ok;
        $surface_check_tidak_ok             = $request->surface_check_tidak_ok;
        $overlap                            = $request->overlap;
        $ls_sa_proportion                   = $request->ls_sa_proportion;
        $volume_kanan                       = $request->volume_kanan;
        $volume_kiri                        = $request->volume_kiri;
        $user_id_inputer                    = app('App\Http\Controllers\resourceController')->dekripsi($request->user_inputer_id);
        // if semua itu okeoke aja 
        if ($airgap == 'OK' && $ts_accurate_kanan == 'OK' && $ts_accurate_kiri == 'OK' && $ls_accurate == 'OK' && $sa_accurate == 'OK' && $surface_check == 'OK' && $pinching == 'OK' && $strip_folding == 'OK' && $konduktivity_kanan == 'OK' && $konduktivity_kiri == 'OK' && $design_kanan == 'OK' && $design_kiri == 'OK' && $dye_test == 'OK' && $residu_h2o2 == 'OK' && $prod_code_no_md == 'OK' && ($ls_sa_proportion !== '10:90' || $ls_sa_proportion !== '90:10') && ($volume_kanan >= 198 || $volume_kanan <= 202) && ($volume_kiri >= 198 || $volume_kiri <= 202)) 
        {
            // pengecekan sampel sebelumnya dimesin tersebut dan saat produk tersebut OK atau tidak OK
            $ambilsemua     = rpdFillingDetailPi::where('rpd_filling_head_id',$rpd_filling_head_id)->where('wo_id',$wo_id)->where('mesin_filling_id',$mesin_filling_id)->get();
            foreach ($ambilsemua as $key => $rpdfillingdetail) 
            {
                if ($rpdfillingdetail->id == $rpd_filling_detail_id_pi) 
                {
                    $idaktif = $key;
                }
            }
            if ($idaktif != '0' ) 
            {
                $datasebelum    = $ambilsemua[$idaktif-1];
            }
            else if ($idaktif == '0') 
            {
                // ini apabila sampel tersebut sampel dengan kode sampel pertama atau kode sampel pertama
                $updatedata     = rpdFillingDetailPi::where('id',$rpd_filling_detail_id_pi)              ->update([
                                    'airgap'                => $airgap,
                                    'ts_accurate_kanan'     => $ts_accurate_kanan,
                                    'ts_accurate_kiri'      => $ts_accurate_kiri,
                                    'ls_accurate'           => $ls_accurate,
                                    'sa_accurate'           => $sa_accurate,
                                    'surface_check'         => $surface_check,
                                    'pinching'              => $pinching,
                                    'strip_folding'         => $strip_folding,
                                    'konduktivity_kanan'    => $konduktivity_kanan,
                                    'konduktivity_kiri'     => $konduktivity_kiri,
                                    'design_kanan'          => $design_kanan,
                                    'design_kiri'           => $design_kiri,
                                    'dye_test'              => $dye_test,
                                    'residu_h2o2'           => $residu_h2o2,
                                    'prod_code_and_no_md'   => $prod_code_no_md,
                                    'correction'            => $correction,
                                    'overlap'               => $overlap,
                                    'ls_sa_proportion'      => $ls_sa_proportion,
                                    'volume_kanan'          => $volume_kanan,
                                    'volume_kiri'           => $volume_kiri,
                                    'user_id_inputer'       => $user_id_inputer,
                                    ]);
                if ($updatedata) 
                {
                    return ['success'=>true,'message'=>'1'];
                }
                else
                {
                    return ['success'=>true,'message'=>'0'];
                }

            }
            

        }

    }
}
