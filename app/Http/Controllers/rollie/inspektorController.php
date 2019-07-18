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
use App\Models\productionData\cppDetail;
use App\Models\productionData\rpdFillingDetailAtEvent;
use App\Models\productionData\kodeSampelPi;
use App\Models\masterApps\mesinFilling;
use App\Models\productionData\palet;
use App\Models\productionData\ppqfg;
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
        if ($rpdfillinghead->status == '1') 
        {
            $rpdfillingaktif    = rpdFillingHead::where('status','1')->get();
            $kode_sampel        = kodeSampelPi::where('jenis_produk_id',$rpdfillinghead->wo[0]->produk->jenis_produk_id)->get();
            return view('rollie.inspektor.rpdfilling',['menus' => $this->menu,'username' => $this->username,'rpd_filling'=>$rpdfillinghead,'rpd_filling_aktif'=>$rpdfillingaktif,'kode_sampel'=>$kode_sampel]); 
        }
        else
        {
            return redirect()->route('dashboard-inspektor-qc')->with('failed','RPD Filling '.$rpdfillinghead->wo[0]->produk->nama_produk.' dengan tanggal produksi '.$rpdfillinghead->wo[0]->production_realisation_date.' Telah diclose');
        }
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
        $datawo->rpd_filling_head_id= $insertrpdfillinghead->id;
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
            if (is_null($value->ls_sa_sealing_quality) && is_null($value->ls_sa_proportion) && is_null($value->status_akhir)) 
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
        $wo_id              = app('App\Http\Controllers\resourceController')->dekripsi($request->nomor_wo);
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
                $jam_event      = $tanggal_filling.' '.$jam_filling;

                $ambilpalet     = DB::connection('mysql4')->select("SELECT * FROM palet where '".$jam_event."' BETWEEN `start` AND `end`");
                $cpp_detail     = cppDetail::where('wo_id',$wo_id)->where('mesin_filling_id',$mesin_filling_id)->get();
                    // dd($cpp_detail);
                foreach ($ambilpalet as $key => $palet) 
                {
                    foreach ($cpp_detail as $key => $cpp_detail_item) 
                    {
                        if ($palet->cpp_detail_id == $cpp_detail_item->id) 
                        {
                            $paletevent     = $palet;
                        }
                    }
                }
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
                    'user_id_inputer'           => $user_id_inputer,
                    'palet_id'                  => $paletevent->id
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
        $status_akhir                        = $request->status_akhir;
        $user_id_inputer                    = app('App\Http\Controllers\resourceController')->dekripsi($request->user_inputer_id);
        // if semua itu okeoke aja 
        if ($airgap == 'OK' && $ts_accurate_kanan == 'OK' && $ts_accurate_kiri == 'OK' && $ls_accurate == 'OK' && $sa_accurate == 'OK' && $surface_check == 'OK' && $pinching == 'OK' && $strip_folding == 'OK' && $konduktivity_kanan == 'OK' && $konduktivity_kiri == 'OK' && $design_kanan == 'OK' && $design_kiri == 'OK' && $dye_test == 'OK' && $residu_h2o2 == 'OK' && $prod_code_no_md == 'OK' && ($ls_sa_proportion !== '10:90' || $ls_sa_proportion !== '90:10' || $ls_sa_proportion !== '80:20' || $ls_sa_proportion !== '70:30') && ($volume_kanan >= 198 || $volume_kanan <= 202) && ($volume_kiri >= 198 || $volume_kiri <= 202) && ($overlap >= 3.5 || $overlap <= 4.5)) 
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
                if ($datasebelum->status_akhir === 'OK') 
                {
                    // ini apabila sampel tersebut sampel dengan kode sampel pertama atau kode sampel pertama
                    $updatedata     = rpdFillingDetailPi::where('id',$rpd_filling_detail_id_pi)->update([
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
                                        'status_akhir'          => $status_akhir,
                                        'user_id_inputer'       => $user_id_inputer,
                                        ]);
                    if ($updatedata) 
                    {
                        return ['success'=>true,'ppq'=>false,'message'=>'1'];
                    }       
                }
                else
                {
                   
                    $updatedata     = rpdFillingDetailPi::where('id',$rpd_filling_detail_id_pi)->update([
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
                                        'status_akhir'          => $status_akhir,
                                        'user_id_inputer'       => $user_id_inputer,
                                        ]);
                    // $html       = view('rollie.inspektor.ppq-fg',['data'=>$data])->render();
                    // return response()->json(['success'=>true,'ppq'=>true,'html'=>$html]);
                    $data       = ['rpd_filling_head_id'=>resourceController::enkripsi($rpd_filling_head_id),'wo_id'=>resourceController::enkripsi($wo_id),'mesin_filling_id'=>resourceController::enkripsi($mesin_filling_id),'id_aktif'=>resourceController::enkripsi($rpd_filling_detail_id_pi)];
                    return ['success'=>true,'ppq'=>true,'isidatanya'=>$data];
                }
            }
            else if ($idaktif == '0') 
            {
                // ini apabila sampel tersebut sampel dengan kode sampel pertama atau kode sampel pertama
                $updatedata     = rpdFillingDetailPi::where('id',$rpd_filling_detail_id_pi)->update([
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
                                    'status_akhir'          => $status_akhir,
                                    'user_id_inputer'       => $user_id_inputer,
                                    ]);
                if ($updatedata) 
                {
                    return ['success'=>true,'ppq'=>false,'message'=>'1'];
                }
            }
        }
        else
        {
            $updatedata     = rpdFillingDetailPi::where('id',$rpd_filling_detail_id_pi)->update([
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
                                        'status_akhir'          => $status_akhir,
                                        'user_id_inputer'       => $user_id_inputer,
                                        ]);
                    if ($updatedata) 
                    {
                        return ['success'=>true, 'ppq'=>false,'message'=>'1'];
                    }
        }

    }
    public function analisaSampelEvent(Request $request)
    {
        $kode_sampel                        = $request->paketan[0];
        $idevent                            = resourceController::dekripsi($request->paketan[1]);
        $wo_id                              = resourceController::dekripsi($request->paketan[2]);
        $event_detail                       = rpdFillingDetailAtEvent::find($idevent);
        if (strpos($kode_sampel, ' (Event)')) 
        {
            $kode_sampel_baru   = explode(' (Event)', $kode_sampel);
            $kode_sampel        = $kode_sampel_baru[0];
        }

        if (strpos($kode_sampel, '(')) 
        {
            $kode_sampel_baru   = explode('(', $kode_sampel);
            $kode_sampel        = $kode_sampel_baru[0];
        }
        switch ($kode_sampel) 
        {
            case 'B':
                $ls_sa_sealing_quality_event        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event             = $request->ls_sa_proportion_event;
                $sideway_sealing_alignment_event    = $request->sideway_sealing_alignment_event;
                $overlap_event                      = $request->overlap_event;
                $package_length_event               = $request->package_length_event;
                $paper_splice_sealing_quality_event = $request->paper_splice_sealing_quality_event;
                $status_akhir                       = $request->status_akhir;
                //update data detail                
                $event_detail->ls_sa_sealing_quality          = $ls_sa_sealing_quality_event;
                $event_detail->ls_sa_proportion               = $ls_sa_proportion_event;
                $event_detail->sideway_sealing_alignment      = $sideway_sealing_alignment_event;
                $event_detail->overlap                        = $overlap_event;
                $event_detail->package_length                 = $package_length_event;
                $event_detail->paper_splice_sealing_quality   = $paper_splice_sealing_quality_event;
                $event_detail->status_akhir                   = $status_akhir;
                $event_detail->save();
                return ['success'=>true,'message'=>'Berhasil']; 
            break;
            case 'C':
                $ls_sa_sealing_quality_event        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event             = $request->ls_sa_proportion_event;
                $sideway_sealing_alignment_event    = $request->sideway_sealing_alignment_event;
                $overlap_event                      = $request->overlap_event;
                $package_length_event               = $request->package_length_event;
                $paper_splice_sealing_quality_event = $request->paper_splice_sealing_quality_event;
                $status_akhir                       = $request->status_akhir;
                //update data detail                
                $event_detail->ls_sa_sealing_quality          = $ls_sa_sealing_quality_event;
                $event_detail->ls_sa_proportion               = $ls_sa_proportion_event;
                $event_detail->sideway_sealing_alignment      = $sideway_sealing_alignment_event;
                $event_detail->overlap                        = $overlap_event;
                $event_detail->package_length                 = $package_length_event;
                $event_detail->paper_splice_sealing_quality   = $paper_splice_sealing_quality_event;
                $event_detail->status_akhir                   = $status_akhir;
                $event_detail->save();
                return ['success'=>true,'message'=>'Berhasil'];
            break;
            case 'D':
                $ls_sa_sealing_quality_event        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event             = $request->ls_sa_proportion_event;
                $ls_sa_sealing_quality_strip        = $request->ls_sa_sealing_quality_strip;
                $status_akhir                       = $request->status_akhir;
                //update data detail                
                $event_detail->ls_sa_sealing_quality            = $ls_sa_sealing_quality_event;
                $event_detail->ls_sa_proportion                 = $ls_sa_proportion_event;
                $event_detail->ls_sa_sealing_quality_strip      = $ls_sa_sealing_quality_strip;
                $event_detail->status_akhir                     = $status_akhir;
                $event_detail->save();
                return ['success'=>true,'message'=>'Berhasil'];
            break;
            case 'E':
                $ls_sa_sealing_quality_event        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event             = $request->ls_sa_proportion_event;
                $ls_sa_sealing_quality_strip        = $request->ls_sa_sealing_quality_strip;
                $status_akhir                       = $request->status_akhir;
                //update data detail                
                $event_detail->ls_sa_sealing_quality            = $ls_sa_sealing_quality_event;
                $event_detail->ls_sa_proportion                 = $ls_sa_proportion_event;
                $event_detail->ls_sa_sealing_quality_strip      = $ls_sa_sealing_quality_strip;
                $event_detail->status_akhir                     = $status_akhir;
                $event_detail->save();
                return ['success'=>true,'message'=>'Berhasil'];
            break;
            case 'F':
                $ls_sa_sealing_quality_event        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event             = $request->ls_sa_proportion_event;
                $ls_short_stop_quality              = $request->ls_short_stop_quality;
                $sa_short_stop_quality              = $request->sa_short_stop_quality;
                $status_akhir                       = $request->status_akhir;
                //update data detail                
                $event_detail->ls_sa_sealing_quality            = $ls_sa_sealing_quality_event;
                $event_detail->ls_sa_proportion                 = $ls_sa_proportion_event;
                $event_detail->ls_short_stop_quality            = $ls_short_stop_quality;
                $event_detail->sa_short_stop_quality            = $sa_short_stop_quality;
                $event_detail->status_akhir                     = $status_akhir;
                $event_detail->save();
                return ['success'=>true,'message'=>'Berhasil'];            
            break;
            case 'G':
                $ls_sa_sealing_quality_event        = $request->ls_sa_sealing_quality_event;
                $ls_sa_proportion_event             = $request->ls_sa_proportion_event;
                $ls_short_stop_quality              = $request->ls_short_stop_quality;
                $sa_short_stop_quality              = $request->sa_short_stop_quality;
                $status_akhir                       = $request->status_akhir;
                //update data detail                
                $event_detail->ls_sa_sealing_quality            = $ls_sa_sealing_quality_event;
                $event_detail->ls_sa_proportion                 = $ls_sa_proportion_event;
                $event_detail->ls_short_stop_quality            = $ls_short_stop_quality;
                $event_detail->sa_short_stop_quality            = $sa_short_stop_quality;
                $event_detail->status_akhir                     = $status_akhir;
                $event_detail->save();
                return ['success'=>true,'message'=>'Berhasil'];            
            break;
        }

    }
    public function tambahWo($jenis_penambahan,$rpd_filling_head_id)
    {
        $rpd_filling_id     = resourceController::dekripsi($rpd_filling_head_id);
        $rpdfillingaktif    = rpdFillingHead::where('status','1')->get();
        switch ($jenis_penambahan) 
        {
            case '1':
                if (count($rpdfillingaktif)>1) 
                {
                    return ['success'=>false,'message'=>'2 RPD Filling Dengan Mesin Berbeda Sudah Aktif . Harap Selesaikan Proses Filling Terlebih Dahulu'];
                }
                else
                {
                    //ini untuk penambahan WO beda mesin
                    if ($rpdfillingaktif[0]->wo[0]->produk->mesinFillingHead->nama_kelompok == 'Brix') 
                    {
                        $wowip      = wo::where('status','2')->whereNotIn('produk_id',['30','31','32'])->get();
                        $arraywo    = array();
                        foreach ($wowip as $key => $value) 
                        {
                            if ($value->produk->mesinFillingHead->nama_kelompok !== 'Brix') 
                            {
                                foreach ($value->produk as $produk)
                                {
                                }
                                array_push($arraywo, $value);
                            }
                        }
                        return ['success'=>true,'data'=>$arraywo];
                    }
                    else if ($rpdfillingaktif[0]->wo[0]->produk->mesinFillingHead->nama_kelompok == 'Prisma') 
                    {
                        $wowip      = wo::where('status','2')->whereNotIn('produk_id',['30','31','32'])->get();
                        $arraywo    = array();
                        foreach ($wowip as $key => $value) 
                        {
                            if ($value->produk->mesinFillingHead->nama_kelompok !== 'Brix') 
                            {
                                array_push($arraywo, $value);
                            }
                        }
                        return ['success'=>true,'data'=>$arraywo];   
                    }
                }
            break;
            //jika tambah produk
            case '2':
                $rpd_filling_head   = rpdFillingHead::find($rpd_filling_id);
                $produk_id          = $rpd_filling_head->wo[0]->produk_id;
                $rangesebelum       = date('Y-m-d', strtotime($rpd_filling_head->wo[0]->production_realisation_date. ' - 2 days'));
                $rangesesudah       = date('Y-m-d', strtotime($rpd_filling_head->wo[0]->production_realisation_date. ' + 2 days'));
                $ambilproduk        = DB::connection('mysql4')->select("SELECT * FROM wo where `production_realisation_date` BETWEEN '".$rangesebelum."' AND '".$rangesesudah."'");
                $arraywo    = array();
                if ($ambilproduk !== []) 
                {
                
                    foreach ($ambilproduk as $key => $value) 
                    {
                        if ($value->produk_id === $produk_id && $value->status == 2) 
                        {
                            $produk        = produk::find($value->produk_id);
                            $value->produk = $produk;
                            array_push($arraywo, $value);
                        }
                    }
                }

                if (count($arraywo) == 0) 
                {
                    return ['success'=>false,'message'=>'Tidak Ada Batch Lain Yang Siap Filling'];
                }
                else
                {
                    return ['success'=>true,'data'=>$arraywo];
                }
                
            break;
        }
    }
    public function tambahWoBatch(Request $request)
    {
        $startfilling               = date('Y-m-d');
        if ($request->jenis_tambah == '1') 
        {
            $datawo                     = wo::where('nomor_wo',$request->nomor_wo_tambah)->first();
            $datawo                     = wo::find($datawo->id);
            $produk_id                  = $datawo->produk_id;
            $datawo->status             = '3';
            //insert ke head table rpd filling
            $insertrpdfillinghead   = rpdFillingHead::create([
                                    'produk_id'     =>$produk_id,
                                    'start_filling' =>$startfilling,
                                    'status'        =>'1'    
                                    ]);
            $datawo->rpd_filling_head_id= $insertrpdfillinghead->id;
            $datawo->tanggal_fillpack   = $startfilling;
            $datawo->save();
            //update data wo ubah status dan ubah tanggal fillpack sesuai dengan start filling hari ini. 
            $return                     = app('App\Http\Controllers\resourceController')->enkripsi($insertrpdfillinghead->id);
            return redirect()->route('rpdfilling-inspektor-qc',['id'=>$return]);
        }
        else if ($request->jenis_tambah == '2') 
        {
            // dd($request->all());
            $rpd_filling_head_id        = resourceController::dekripsi($request->rpd_filling_head_idnya);
            $datawo                     = wo::where('nomor_wo',$request->nomor_wo_tambah)->first();
            $datawo                     = wo::find($datawo->id);
            $datawo->rpd_filling_head_id= $rpd_filling_head_id;
            $datawo->tanggal_fillpack   = $startfilling;
            $datawo->status             = '3';
            $datawo->save();
            return redirect()->route('rpdfilling-inspektor-qc',['id'=>$request->rpd_filling_head_idnya]);
        }
    }
    public function viewPPQ($rpd_filling_head_id,$wo_id,$mesin_filling_id,$rpd_filling_detail_id_pi)
    {   
        $rpd_filling_head_id        = resourceController::dekripsi($rpd_filling_head_id);
        $wo_id                      = resourceController::dekripsi($wo_id);
        $mesin_filling_id           = resourceController::dekripsi($mesin_filling_id);
        $rpd_filling_detail_id_pi   = resourceController::dekripsi($rpd_filling_detail_id_pi);

        $ambilsemua     = rpdFillingDetailPi::where('rpd_filling_head_id',$rpd_filling_head_id)->where('wo_id',$wo_id)->where('mesin_filling_id',$mesin_filling_id)->get();
        foreach ($ambilsemua as $key => $rpdfillingdetail) 
        {
            if ($rpdfillingdetail->id == $rpd_filling_detail_id_pi) 
            {
                $idaktif = $key;
            }
        }
        $ambil_wo       = wo::find($wo_id);
        $ambil_mesin    = mesinFilling::find($mesin_filling_id);
        $ppq            = ppqfg::all();
        $ppqakhir       = $ppq->last();
        if ($ppqakhir !== null) 
        {      
          $pecah      = explode('/', $ppqakhir->no_ppq);
        }
        else
        {
          $pecah = null;
        }
        if($pecah == null)
        {
          $x   = 1;
        }
        else
        {
          $x   = $pecah['0']+1;
        }

        if (strlen($x) == 1) 
        {
            $x = '00'.$x;
        }
        else if(strlen($x) == 2)
        {
            $x = '0'.$x;
        }
        else if (strlen($x) == 3) 
        {
            $x = $x;
        }

        $bulan          = ['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
        $nomor_ppq      = $x.'/PPQ/'.$bulan[date('m')].'/'.date('Y');
        $jumlahdata     = count($ambilsemua);
        $idsebelum      = $idaktif-1;

        while ($idsebelum >= 0) 
        {
            $ceksebelumnya = $ambilsemua[$idsebelum-1];
            if ($ceksebelumnya->status_akhir == 'OK') 
            {
                $oksebelum  = $ceksebelumnya;
                break;
            }
            else
            {
                $idsebelum = $idsebelum-1;
            }
        }
        $jam_filling_mulai      = $oksebelum->tanggal_filling.' '.$oksebelum->jam_filling;
        $jam_filling_akhir      = $ambilsemua[$idaktif]->tanggal_filling.' '.$ambilsemua[$idaktif]->jam_filling;
        $cppdetail              = cppDetail::where('wo_id',$ambilsemua[$idaktif]->wo_id)->where('mesin_filling_id',$ambilsemua[$idaktif]->mesin_filling_id)->first();
        // $palet                  = palet::where('cpp_detail_id',$cppdetail->id)->get();
        $paletmulai             =   DB::connection('mysql4')->select("SELECT * FROM palet where '".$jam_filling_mulai."' BETWEEN `start` AND `end`");
        foreach ($paletmulai as $key => $value) 
        {
            if ($value->cpp_detail_id === $cppdetail->id) 
            {
                $palet_mulai = $value;
            }
        }

        $paletakhir             =   DB::connection('mysql4')->select("SELECT * FROM palet where '".$jam_filling_akhir."' BETWEEN `start` AND `end` OR '".$jam_filling_akhir."' >= `start` AND `end` IS NULL ");
        foreach ($paletakhir as $key => $value) 
        {
            if ($value->cpp_detail_id === $cppdetail->id) 
            {
                $palet_akhir = $value;
            }
        }
        
        $ambilpalet             =   DB::connection('mysql4')->select("SELECT * FROM palet where SUBSTR(`palet`,2,2) BETWEEN SUBSTR('".$palet_mulai->palet."',2,2) AND SUBSTR('".$palet_akhir->palet."',2,2)");
        $paletfix               = array();
        $jumlahpack             = 0;
        foreach ($ambilpalet as $key => $paletnya) 
        {
            if ($paletnya->cpp_detail_id === $cppdetail->id) 
            {
                $cppdetailnya   = cppDetail::find($paletnya->cpp_detail_id);
                $paletnya->cpp_detail       = $cppdetailnya;
                $jumlahpack+=$paletnya->jumlah_pack;
                array_push($paletfix,$paletnya);
            }
        }
        $isi    = array('nama_produk' => $ambil_wo->produk->nama_produk, 'tanggal_produksi'=> $ambil_wo->production_realisation_date, 'mesin_filling'=> $ambil_mesin->kode_mesin,'mesin_filling_id' => resourceController::enkripsi($ambil_mesin->id),'tanggal_ppq'=>date('Y-m-d'),'nomor_ppq'=>$nomor_ppq,'kode_oracle'=>$ambil_wo->produk->kode_oracle, 'palet'=>$paletfix,'jam_filling_mulai'=>$jam_filling_mulai,'jam_filling_akhir'=>$jam_filling_akhir,'nomor_wo'=>$ambil_wo->nomor_wo,'jumlah_pack'=>$jumlahpack,'jenis_ppq'=>'3','rpd_filling_head_id'=>resourceController::enkripsi($rpd_filling_head_id));
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
        return view('rollie.inspektor.ppq-fg',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'data'=>$isi]);
    }
    public function tambahPpq(Request $request)
    {
        $nomor_ppq          = $request->nomor_ppq;
        $tanggal_ppq        = $request->tanggal_ppq;
        $jam_awal_ppq       = $request->jam_filling_mulai;
        $jam_akhir_ppq      = $request->jam_filling_akhir;
        $jumlah_pack        = $request->jumlah_pack;
        $alasan             = $request->alasan_ppq;
        $jenis_ppq          = $request->jenis_ppq;
        $kategori_ppq       = $request->kategori_ppq_value;
        $user_inputer_id    = $request->user_inputer_id;
        $status_akhir       = '0';
        
        $nomor_lot_id       = $request->nomor_lot_id;
        $pecah              = explode(',',$nomor_lot_id);
        if (count($pecah) > 1) 
        {
            $nomor_lot_id   = rtrim($nomor_lot_id,',');
        }
        $ppq                = ppqfg::create([
                                'nomor_ppq'     => $nomor_ppq,
                                'tanggal_ppq'   => $tanggal_ppq,
                                'jam_awal_ppq'  => $jam_awal_ppq,
                                'jam_akhir_ppq' => $jam_akhir_ppq,
                                'jumlah_pack'   => $jumlah_pack,
                                'alasan'        => $alasan,
                                'jenis_ppq'     => $jenis_ppq,
                                'kategori_ppq'  => $kategori_ppq,
                                'user_inputer_id'=> $user_inputer_id,
                                'status_akhir'  => $status_akhir
                            ]);
        if ($ppq) 
        {
            foreach ($pecah as $key => $idpalet) 
            {
                $palet          = palet::find($idpalet);
                if (!is_null($palet)) 
                {
                    $palet->ppq_id  = $ppq->id;
                    $palet->save();
                }
            }
            return redirect()->route('rpdfilling-inspektor-qc',['id'=>$request->rpd_filling_head_id]);
        }
    }

    public function closeRpd(Request $request)
    {
        $rpd_filling_head_id    = resourceController::dekripsi($request->rpd_filling_head_id);
        $rpd_filling_head       = rpdFillingHead::find($rpd_filling_head_id);
        foreach ($rpd_filling_head->detail_pi as $key => $value)
        {
            if (is_null($value->status_akhir)) 
            {
                return ['success'=>false,'message'=>'Masih ada sampel yang belum dianalisa. Harap selesaikan semua draft analisa lalu close rpd filling.'];
            }
        }   
        foreach ($rpd_filling_head->detail_at_event as $key => $value) 
        {
            if (is_null($value->status_akhir)) 
            {

                // dd($value);
                return ['success'=>false,'message'=>'Masih ada sampel yang belum dianalisa. Harap selesaikan semua draft analisa lalu close rpd filling.'];
            }
        }

        $rpd_filling_head->status   = '2';
        $rpd_filling_head->save();
        foreach ($rpd_filling_head->wo as $key => $value) 
        {
            $wonya         = wo::find($value->id);
            if ($wonya->cppHead->status == '1') 
            {
                $wonya->status = '4';
                $wonya->save();
            }
        }
        return ['success'=>true,'message'=>'RPD Filling sudah terselesaikan.'];

    }
}
