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
use App\Models\productionData\ppqfg;
use App\Models\productionData\paletPpq;
use App\Models\productionData\analisaKimia;
use App\Models\productionData\analisaMikro;
use App\Models\productionData\analisaMikroDetail;
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
            $this->menu = DB::connection('master_apps')->table('v_hak_akses')->where('user_id',Session::get('login'))
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
        return view('rollie.analisa-kimia',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$listcpp,'produks'=>$produk,'wo'=>$wo]);
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
        foreach ($cpps->analisaKimia as $key => $analisaKimia) 
        {
        
        }
        if (!is_null($cpps->analisaKimia)) 
        {
            if ($cpps->analisaKimia->status == 1) 
            {
                return redirect()->route('lihat-analisa-produk',['id'=>resourceController::enkripsi($cpps->analisaKimia->id)])->with('info','Produk telah melakukan analisa');
            }
            else
            {
                return view('rollie.analisa-kimia-analisa',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$cpps]);

            }
        }
        else
        {
            return view('rollie.analisa-kimia-analisa',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$cpps]);

        }
        // return view('');
    }
    public function inputAnalisaKimia(Request $request)
    {
        $nama_produk                    = $request->nama_produk;
        $cpp_head_id                    = resourceController::dekripsi($request->cpp_head_id);
        $analisa_kimia_id               = resourceController::dekripsi($request->analisa_kimia_id);
        $nomor_wo                       = $request->nomor_wo;
        $nomor_lot                      = $request->nomor_lot;
        $kode_oracle                    = $request->kode_oracle;
        $spek_ts_min                    = $request->spek_ts_min;
        $spek_ts_max                    = $request->spek_ts_max;
        $spek_ph_min                    = $request->spek_ph_min;
        $spek_ph_max                    = $request->spek_ph_max;
        $ts_awal_1                      = $request->ts_awal_1;
        $ts_awal_2                      = $request->ts_awal_2;
        $ts_tengah_1                    = $request->ts_tengah_1;
        $ts_tengah_2                    = $request->ts_tengah_2;
        $ts_akhir_1                     = $request->ts_akhir_1;
        $ts_akhir_2                     = $request->ts_akhir_2;
        $ts_awal_sum                    = $request->ts_awal_sum;
        $ts_tengah_sum                  = $request->ts_tengah_sum;
        $ts_akhir_sum                   = $request->ts_akhir_sum;
        $kode_batch                     = $request->kode_batch;
        $ph_awal                        = $request->ph_awal;
        $ph_tengah                      = $request->ph_tengah;
        $ph_akhir                       = $request->ph_akhir;
        $visco_awal                     = $request->visco_awal;
        $visco_tengah                   = $request->visco_tengah;
        $visco_akhir                    = $request->visco_akhir;
        $sensory_awal                   = $request->sensory_awal;
        $sensory_tengah                 = $request->sensory_tengah;
        $sensory_akhir                  = $request->sensory_akhir;
        $jam_filling_awal               = $request->jam_filling_awal;
        $jam_filling_tengah             = $request->jam_filling_tengah;
        $jam_filling_akhir              = $request->jam_filling_akhir;
        $keterangan                     = $request->status_akhir;
        $paletnya                       = array();
        $cpp_head                       = cppHead::find($cpp_head_id);
        foreach ($cpp_head->cppDetail as $key => $cpp_detail) 
        {
            foreach ($cpp_detail->palet as $key => $palet) 
            {
                array_push($paletnya,$palet);
            }
        }
        if (strpos($keterangan, '#OK')) 
        {
            $status_akhir                   = '#OK';
        }
        else
        {
            $status_akhir                   = 'OK';
        }
        
        $fullname_input                 = $request->fullname_input;
        $user_inputer_id                = $request->user_inputer_id;
        $simpan                         = $request->simpan;
        if ($simpan == 'draft') 
        {
            $analisaKimia       = analisaKimia::create([
                'kode_batch_standar'    => $kode_batch,
                'ts_awal_1'             => $ts_awal_1,
                'ts_awal_2'             => $ts_awal_2,
                'ts_awal_sum'           => $ts_awal_sum,
                'ts_tengah_1'           => $ts_tengah_1,
                'ts_tengah_2'           => $ts_tengah_2,
                'ts_tengah_sum'         => $ts_tengah_sum,
                'ts_akhir_1'            => $ts_akhir_1,
                'ts_akhir_2'            => $ts_akhir_2,
                'ts_akhir_sum'          => $ts_akhir_sum,
                'ph_awal'               => $ph_awal,
                'ph_tengah'             => $ph_tengah,
                'ph_akhir'              => $ph_akhir,
                'visco_awal'            => $visco_awal,
                'visco_tengah'          => $visco_tengah,
                'visco_akhir'           => $visco_akhir,
                'sensory_awal'          => $sensory_awal,
                'sensory_tengah'        => $sensory_tengah,
                'sensory_akhir'         => $sensory_akhir,
                'jam_filling_awal'      => $jam_filling_awal,
                'jam_filling_tengah'    => $jam_filling_tengah,
                'jam_filling_akhir'     => $jam_filling_akhir,
                'status'                => '0',
                'status_akhir'          => $status_akhir,
                'keterangan'            => $keterangan,
                'user_id_inputer'       => resourceController::dekripsi($user_inputer_id)
            ]);
            $cpp_head                   = cppHead::find($cpp_head_id);
            $cpp_head->analisa_kimia_id = $analisaKimia->id;
            $cpp_head->save();
            return redirect()->route('analisa-kimia-fg')->with('success','Analisa Kimia FG Berhasil Disimpan');
        }
        else if ($simpan == 'simpan')
        {
            /* Pengecekan Status PPQ*/
            $ambil_palet         = '';
            $keterangan_awal     = '';
            $keterangan_tengah   = '';
            $keterangan_akhir    = '';
            if ($ts_awal_sum < $spek_ts_min ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'TS DROP'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."TS DROP ";
                }
            }
            if ($ts_tengah_sum < $spek_ts_min ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'TS DROP'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."TS DROP ";
                }
            }
            if ($ts_akhir_sum < $spek_ts_min ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'TS DROP'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."TS DROP ";
                }
            }

            if ($ts_awal_sum > $spek_ts_max ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'TS OVER'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."TS OVER ";
                }
            }
            if ($ts_tengah_sum > $spek_ts_max ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'TS OVER'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."TS OVER ";
                }
            }
            if ($ts_akhir_sum > $spek_ts_max ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'TS Akhir'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."TS Akhir ";
                }
            }

            if ($ph_awal < $spek_ph_min ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'pH DROP'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."pH DROP ";
                }
            }
            if ($ph_tengah < $spek_ph_min ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'pH DROP'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."pH DROP ";
                }
            }
            if ($ph_akhir < $spek_ph_min ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'pH DROP'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."pH DROP ";
                }
            }
            
            if ($ph_awal > $spek_ph_max ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'pH OVER'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."pH OVER ";
                }
            }
            if ($ph_tengah > $spek_ph_max ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'pH OVER'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."pH OVER ";
                }
            }
            if ($ph_akhir > $spek_ph_max ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'pH Akhir'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."pH Akhir ";
                }
            }

            if ($sensory_awal === '#OK' ) 
            {
                if (strpos($ambil_palet,'Awal')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Awal ";
                }

                if (strpos($keterangan_awal,'Sensori Awal #OK'))
                {
                    $keterangan_awal = $keterangan_awal;
                }
                else
                {
                    $keterangan_awal = $keterangan_awal."Sensori Awal #OK ";
                }
            }
            if ($sensory_tengah === '#OK' ) 
            {
                if (strpos($ambil_palet,'Tengah')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Tengah ";
                }

                if (strpos($keterangan_tengah,'Sensori Tengah #OK'))
                {
                    $keterangan_tengah = $keterangan_tengah;
                }
                else
                {
                    $keterangan_tengah = $keterangan_tengah."Sensori Tengah #OK ";
                }
            }
            if ($sensory_akhir === '#OK' ) 
            {
                if (strpos($ambil_palet,'Akhir')) 
                {
                    $ambil_palet = $ambil_palet;
                }
                else
                {
                    $ambil_palet = $ambil_palet."Akhir ";
                }

                if (strpos($keterangan_akhir,'Sensori Akhir #OK'))
                {
                    $keterangan_akhir = $keterangan_akhir;
                }
                else
                {
                    $keterangan_akhir = $keterangan_akhir."Sensori Akhir #OK ";
                }
            }
            /* Akhir Cek Apa Ada PPQ */
            /*Pengambilan Nomor PPQ*/
            $ppq            = ppqfg::all();
            $ppqakhir       = $ppq->last();
            if ($ppqakhir !== null) 
            {      
              $pecah      = explode('/', $ppqakhir->nomor_ppq);
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
            /*Akhir Nomor PPQ*/

            if (!is_null($analisa_kimia_id)) 
            {
                $analisaKimia       = analisaKimia::where('id',$analisa_kimia_id)->update([
                    'kode_batch_standar'    => $kode_batch,
                    'ts_awal_1'             => $ts_awal_1,
                    'ts_awal_2'             => $ts_awal_2,
                    'ts_awal_sum'           => $ts_awal_sum,
                    'ts_tengah_1'           => $ts_tengah_1,
                    'ts_tengah_2'           => $ts_tengah_2,
                    'ts_tengah_sum'         => $ts_tengah_sum,
                    'ts_akhir_1'            => $ts_akhir_1,
                    'ts_akhir_2'            => $ts_akhir_2,
                    'ts_akhir_sum'          => $ts_akhir_sum,
                    'ph_awal'               => $ph_awal,
                    'ph_tengah'             => $ph_tengah,
                    'ph_akhir'              => $ph_akhir,
                    'visco_awal'            => $visco_awal,
                    'visco_tengah'          => $visco_tengah,
                    'visco_akhir'           => $visco_akhir,
                    'sensory_awal'          => $sensory_awal,
                    'sensory_tengah'        => $sensory_tengah,
                    'sensory_akhir'         => $sensory_akhir,
                    'jam_filling_awal'      => $jam_filling_awal,
                    'jam_filling_tengah'    => $jam_filling_tengah,
                    'jam_filling_akhir'     => $jam_filling_akhir,
                    'status'                => '1',
                    'status_akhir'          => $status_akhir,
                    'keterangan'            => $keterangan,
                    'user_id_inputer'       => resourceController::dekripsi($user_inputer_id)
                ]);
            }
            else
            {
                $analisaKimia       = analisaKimia::create([
                    'kode_batch_standar'    => $kode_batch,
                    'ts_awal_1'             => $ts_awal_1,
                    'ts_awal_2'             => $ts_awal_2,
                    'ts_awal_sum'           => $ts_awal_sum,
                    'ts_tengah_1'           => $ts_tengah_1,
                    'ts_tengah_2'           => $ts_tengah_2,
                    'ts_tengah_sum'         => $ts_tengah_sum,
                    'ts_akhir_1'            => $ts_akhir_1,
                    'ts_akhir_2'            => $ts_akhir_2,
                    'ts_akhir_sum'          => $ts_akhir_sum,
                    'ph_awal'               => $ph_awal,
                    'ph_tengah'             => $ph_tengah,
                    'ph_akhir'              => $ph_akhir,
                    'visco_awal'            => $visco_awal,
                    'visco_tengah'          => $visco_tengah,
                    'visco_akhir'           => $visco_akhir,
                    'sensory_awal'          => $sensory_awal,
                    'sensory_tengah'        => $sensory_tengah,
                    'sensory_akhir'         => $sensory_akhir,
                    'jam_filling_awal'      => $jam_filling_awal,
                    'jam_filling_tengah'    => $jam_filling_tengah,
                    'jam_filling_akhir'     => $jam_filling_akhir,
                    'status'                => '1',
                    'status_akhir'          => $status_akhir,
                    'keterangan'            => $keterangan,
                    'user_id_inputer'       => resourceController::dekripsi($user_inputer_id)
                ]);
                $cpp_head                   = cppHead::find($cpp_head_id);
                $cpp_head->analisa_kimia_id = $analisaKimia->id;
                $cpp_head->save();
            }

            if (( strpos($ambil_palet,"Awal") !== false && strpos($ambil_palet,"Akhir") !== false ) || strpos($ambil_palet,"Tengah") !== false ) 
            {
                // ini ppq palet semua
                if (!is_null($keterangan_awal) && is_null($keterangan_tengah) && is_null($keterangan_akhir)) 
                {
                    $alasan_ppq = "Palet Awal : ".$keterangan_awal;
                }
                else if(!is_null($keterangan_awal) && !is_null($keterangan_tengah) && is_null($keterangan_akhir) )
                {
                    $alasan_ppq = "Palet Awal : ".$keterangan_awal.", Palet Tengah : ".$keterangan_tengah;
                }
                else if(!is_null($keterangan_awal) && !is_null($keterangan_tengah) && !is_null($keterangan_akhir) )
                {
                    $alasan_ppq = "Palet Awal : ".$keterangan_awal.", Palet Tengah : ".$keterangan_tengah.", Palet Akhir : ".$keterangan_akhir;
                }
                else if(!is_null($keterangan_awal) && is_null($keterangan_tengah) && !is_null($keterangan_akhir) )
                {
                    $alasan_ppq = "Palet Awal : ".$keterangan_awal.", Palet Akhir : ".$keterangan_akhir;
                }
                else if(is_null($keterangan_awal) && !is_null($keterangan_tengah) && !is_null($keterangan_akhir) )
                {
                    $alasan_ppq = "Palet Tengah : ".$keterangan_tengah.", Palet Akhir : ".$keterangan_akhir;
                }

                foreach ($paletnya as $key => $inipalet) 
                {
                    $cpp_detail             = cppDetail::find($inipalet->cpp_detail_id);
                    $inipalet->cpp_detail   =  $cpp_detail;
                    array_push($paletfix,$inipalet);
                    $jumlah_pack            += $inipalet->jumlah_pack;
                }
                return view('rollie.ppq',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'data'=>$isi,'cpp_head'=>$cpp_head,'info'=>"Data analisa kimia produk ".$cpp_head->wo[0]->produk->nama_produk." #OK . Harap membuat dan melengkapi Form PPQ untuk tindakan Koreksi"]);

            }
            else if ( strpos($ambil_palet,'Awal')!== false && (strpos($ambil_palet, 'Akhir') !== true && strpos($ambil_palet,'Tengah') !== true ) )
            {
                // ini ppq palet awal aja
                if ($keterangan_tengah !== '') 
                {
                    $alasan_ppq         = "Palet Tengah : ".$keterangan_tengah.', Palet Awal : '.$keterangan_awal;
                }
                else
                {
                    $alasan_ppq         = $keterangan_awal;
                }
                $paletfix       = array();
                $jumlah_pack = 0;
                foreach ($paletnya as $key => $inipalet) 
                {
                    if ( ($jam_filling_awal >= $inipalet->start && $jam_filling_awal <= $inipalet->end) || ($inipalet->start >= $jam_filling_awal && $inipalet->end <= $jam_filling_tengah) || ($jam_filling_tengah >= $inipalet->start && $jam_filling_tengah <= $inipalet->end) ) 
                    {
                        $cpp_detail             = cppDetail::find($inipalet->cpp_detail_id);
                        $inipalet->cpp_detail   =  $cpp_detail;
                        array_push($paletfix,$inipalet);
                        $jumlah_pack            += $inipalet->jumlah_pack;
                    }
                }
                $isi    = array('nama_produk' => $cpp_head->wo[0]->produk->nama_produk, 'tanggal_ppq'=>date('Y-m-d'),'nomor_ppq'=>$nomor_ppq,'kode_oracle'=>$cpp_head->wo[0]->produk->kode_oracle, 'palet'=>$paletfix,'jam_filling_mulai'=>$jam_filling_tengah,'jam_filling_akhir'=>$jam_filling_akhir,'jumlah_pack'=>$jumlah_pack,'jenis_ppq'=>'0','alasan_ppq'=>$alasan_ppq);

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
                return view('rollie.ppq',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'data'=>$isi,'cpp_head'=>$cpp_head,'info'=>"Data analisa kimia produk ".$cpp_head->wo[0]->produk->nama_produk." #OK . Harap membuat dan melengkapi Form PPQ untuk tindakan Koreksi"]);
            }
            else if (strpos($ambil_palet,'Akhir')!== false && ( strpos($ambil_palet, 'Awal') !== true && strpos($ambil_palet,'Tengah') != true) ) 
            {
                if ($keterangan_tengah !== '') 
                {
                    $alasan_ppq         = "Palet Tengah : ".$keterangan_tengah.', Palet Akhir : '.$keterangan_akhir;
                }
                else
                {
                    $alasan_ppq         = $keterangan_akhir;
                }
                $paletfix       = array();
                $jumlah_pack = 0;
                foreach ($paletnya as $key => $inipalet) 
                {
                    if ( ($jam_filling_tengah >= $inipalet->start && $jam_filling_tengah <= $inipalet->end) || ($inipalet->start >= $jam_filling_tengah && $inipalet->end <= $jam_filling_akhir) ) 
                    {
                        $cpp_detail             = cppDetail::find($inipalet->cpp_detail_id);
                        $inipalet->cpp_detail   =  $cpp_detail;
                        array_push($paletfix,$inipalet);
                        $jumlah_pack            += $inipalet->jumlah_pack;
                    }
                }
                $isi    = array('nama_produk' => $cpp_head->wo[0]->produk->nama_produk, 'tanggal_ppq'=>date('Y-m-d'),'nomor_ppq'=>$nomor_ppq,'kode_oracle'=>$cpp_head->wo[0]->produk->kode_oracle, 'palet'=>$paletfix,'jam_filling_mulai'=>$jam_filling_tengah,'jam_filling_akhir'=>$jam_filling_akhir,'jumlah_pack'=>$jumlah_pack,'jenis_ppq'=>'0','alasan_ppq'=>$alasan_ppq);

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
                return view('rollie.ppq',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'data'=>$isi,'cpp_head'=>$cpp_head,'info'=>"Data analisa kimia produk ".$cpp_head->wo[0]->produk->nama_produk." #OK . Harap membuat dan melengkapi Form PPQ untuk tindakan Koreksi"]);
            }
            else
            {
                return redirect()->route('analisa-kimia-fg')->with('success','Hasil Analisa Kimia Produk '.$cpp_head->wo[0]->nama_produk.' Berhasil Diinput');
                    
            }
            
        }
    }
    public function lihatAnalisaKimia($id_analisa_kimia)
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
        $analisa_kimia_id   = resourceController::dekripsi($id_analisa_kimia);
        $analisa_kimia      = analisaKimia::find($analisa_kimia_id);
        return view('rollie.lihat-analisa-kimia',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'analisa_kimia'=>$analisa_kimia]);
    }
    public function inputPPQ(Request $request)
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
                    $insertPaletPPQ     = paletPpq::create([
                        'palet_id'  => $palet->id,
                        'ppq_id'    => $ppq->id
                    ]);
                }
            }
            return redirect()->route('analisa-kimia-fg')->with('success','PPQ Produk'.$request->nama_produk.' dengan Nomor PPQ : '.$nomor_ppq);
        }
    
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
    public function ppq()
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
        return view('rollie.ppq',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data]);
    }

    public function analisaMikro()
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
        return view('rollie.analisa-mikro',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$listcpp,'produks'=>$produk,'wo'=>$wo]);
        // return view('rollie.analisaMikro');
    }
    public function prosesAnalisaMikro($cpp_head_id)
    {
        $cpp_head_id        = resourceController::dekripsi($cpp_head_id);
        $analisaMikro       = analisaMikro::where('cpp_head_id',$cpp_head_id)->first();
        if (is_null($analisaMikro)) 
        {
            $tanggal_analisa    = date('Y-m-d');
            $user_inputer       = $this->username;
            $analisaMikroInput  = analisaMikro::create([
                'cpp_head_id'       => $cpp_head_id,
                'tanggal_analisa'   => $tanggal_analisa,
                'status_analisa'    => 'On Progress',
                'user_inputer_id'   => $user_inputer->user->id
            ]);
            $cppHead        = cppHead::find($cpp_head_id);
            $counting       = 1;
            $countingR      = 1;
            $pi_biasa       = array();
            $pi_R           = array();
            foreach ($cppHead->wo as $key => $wo) 
            {
                foreach ($wo->rpdFillingDetail as $key => $rpd_filling_detail) 
                {
                    if (strpos($rpd_filling_detail->kode_sampel->kode_sampel, 'R') === false && $rpd_filling_detail->kode_sampel->mikro30 > 0) 
                    {
                        for ($i = $counting; $i < $counting+$rpd_filling_detail->kode_sampel->mikro30 ; $i++) 
                        {
                            if (strpos($rpd_filling_detail->kode_sampel->kode_sampel,'(') !== false) 
                            {
                                $pecah_kode_sampel      = explode('(',$rpd_filling_detail->kode_sampel->kode_sampel);
                                $pecah_kode_sampel_2    = explode(')',$pecah_kode_sampel[1]);
                                $kode_sampel            = $pecah_kode_sampel[0].$i.'-'.$pecah_kode_sampel_2[0];
                            }
                            else
                            {
                                $kode_sampel            = $rpd_filling_detail->kode_sampel->kode_sampel.$i;
                            }
                            $simpan = analisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikroInput->id,
                                'kode_sampel'              => $kode_sampel,
                                'jam_filling'              => $rpd_filling_detail->tanggal_filling.' '.$rpd_filling_detail->jam_filling,
                                'rpd_filling_detail_id'    => $rpd_filling_detail->id,
                                'suhu_preinkubasi'         => '30', 
                                'status'                   => '0', 
                            ]);
                        }
                        $counting = $i;
                    }
                    else if (strpos($rpd_filling_detail->kode_sampel->kode_sampel, 'R') !== false && $rpd_filling_detail->kode_sampel->mikro30 > 0)
                    {

                        for ($i = $countingR; $i < $countingR+$rpd_filling_detail->kode_sampel->mikro30 ; $i++) 
                        {
                            if (strpos($rpd_filling_detail->kode_sampel->kode_sampel,'(') !== false) 
                            {
                                $pecah_kode_sampel      = explode('(',$rpd_filling_detail->kode_sampel->kode_sampel);
                                $pecah_kode_sampel_2    = explode(')',$pecah_kode_sampel[1]);
                                $kode_sampel            = $pecah_kode_sampel[0].$i.'-'.$pecah_kode_sampel_2[0];
                            }
                            else
                            {
                                $kode_sampel            = $rpd_filling_detail->kode_sampel->kode_sampel.$i;
                            }
                            analisaMikroDetail::create([
                                'analisa_mikro_id'         => $analisaMikroInput->id,
                                'kode_sampel'              => $kode_sampel,
                                'jam_filling'              => $rpd_filling_detail->tanggal_filling.' '.$rpd_filling_detail->jam_filling,
                                'rpd_filling_detail_id'    => $rpd_filling_detail->id,
                                'suhu_preinkubasi'         => '30', 
                                'status'                   => '0', 
                            ]);
                        }
                        $countingR = $i;
                    }
                }
                if ($wo->produk->jenisProduk->jenis_produk == 'susu') 
                {
                    foreach ($wo->rpdFillingDetail->unique('mesin_filling_id') as $key => $mesin_filling)
                    {
                        analisaMikroDetail::create([
                            'analisa_mikro_id'         => $analisaMikroInput->id,
                            'kode_sampel'              => 'AW',
                            'jam_filling'              => $mesin_filling->wo->cppHead->analisaKimia->jam_filling_awal,
                            'rpd_filling_detail_id'    => $mesin_filling->id,
                            'suhu_preinkubasi'         => '55', 
                            'status'                   => '0', 
                        ]);

                        analisaMikroDetail::create([
                            'analisa_mikro_id'         => $analisaMikroInput->id,
                            'kode_sampel'              => 'TG',
                            'jam_filling'              => $mesin_filling->wo->cppHead->analisaKimia->jam_filling_tengah,
                            'rpd_filling_detail_id'    => $mesin_filling->id,
                            'suhu_preinkubasi'         => '55', 
                            'status'                   => '0', 
                        ]);

                        analisaMikroDetail::create([
                            'analisa_mikro_id'         => $analisaMikroInput->id,
                            'kode_sampel'              => 'AK',
                            'jam_filling'              => $mesin_filling->wo->cppHead->analisaKimia->jam_filling_tengah,
                            'rpd_filling_detail_id'    => $mesin_filling->id,
                            'suhu_preinkubasi'         => '55', 
                            'status'                   => '0', 
                        ]);
                    }
                }
                // return $pi_biasa;
            }

            $hakAksesUserAplikasi       = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
            $hakAksesAplikasi           = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
            $dataanalisaMikro           = analisaMikro::find($analisaMikroInput->id);
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
            return view('rollie.analisa-mikro-analisa',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'analisaMikro'=>$dataanalisaMikro]);
        }
        else
        {
            $hakAksesUserAplikasi       = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
            $hakAksesAplikasi           = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
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
            return view('rollie.analisa-mikro-analisa',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'analisaMikro'=>$analisaMikro]);
        }
    }

    public function inputAnalisaMikro(Request $request)
    {
        // $data               = array();
        $status_akhir       = array();
        foreach ($request->all() as $key => $data) 
        {
            if ($key !== '_token' && $key !== 'cekHakAkses' && $key !== 'analisa_mikro_head_id') 
            {
                $produk         = produk::find($data['produk_id']);
                $datapalet      = DB::connection('production_data')->select("SELECT * FROM palet where '".$data['jam_filling']."' BETWEEN `start` AND `end`");
                $cpp_details    = explode(',',$data['cpp_detail']);
                $paletfix       = array();
                foreach ($datapalet as $kunci => $palet)
                {
                    foreach ($cpp_details as $cpp_detail_id) 
                    {
                        if ($cpp_detail_id !== '') 
                        {
                            if ($palet->cpp_detail_id == $cpp_detail_id) 
                            {
                                array_push($paletfix,$palet);
                            }
                        }
                    }
                }
                if (($data['ph'] >= $produk->spek_ph_min && $data['ph'] <= $produk->spek_ph_max) && $data['tpc'] == 0) 
                {   
                    if ($produk->kode_oracle == '7300861') 
                    {
                        if ($data['yeast'] == 0 && $data['mold'] == 0)
                        {
                            foreach ($paletfix as $kuncilagi => $palet) 
                            {
                                $ambil_palet    = palet::find($palet->id);
                                $ambil_palet->status_analisa_mikro = '1';
                                $ambil_palet->save();
                                array_push($status_akhir,"#OK");
                                $data['status'] = '2';
                            }
                        }
                        else
                        {
                            foreach ($paletfix as $kunciterus => $palet) 
                            {
                                $ambil_palet    = palet::find($palet->id);
                                $ambil_palet->status_analisa_mikro = '0';
                                $ambil_palet->save();
                                array_push($status_akhir,"OK");
                                $data['status'] = '1';

                            }
                        }
                    }
                    else
                    {
                        foreach ($paletfix as $kuncifix => $palet) 
                        {
                            $ambil_palet    = palet::find($palet->id);
                            $ambil_palet->status_analisa_mikro = '0';
                            $ambil_palet->save();
                            array_push($status_akhir,"OK");
                            $data['status'] = '1';    
                        }
                    }
                }
                else
                {
                    foreach ($paletfix as $kuncinya => $palet) 
                    {
                        $ambil_palet    = palet::find($palet->id);
                        $ambil_palet->status_analisa_mikro = '1';
                        $ambil_palet->save();
                        array_push($status_akhir,"#OK");
                        $data['status'] = '2';

                    }
                }
                unset($data['cpp_detail']);
                unset($data['produk_id']);
                analisaMikroDetail::where('id',$key)->update($data);
            }
        }
        if (in_array('#OK', $status_akhir)) 
        {
            $analisa_mikro_head_id          = resourceController::dekripsi($request->analisa_mikro_head_id);
            $analisa_mikro                  = analisaMikro::find($analisa_mikro_head_id);
            $analisa_mikro->status_analisa  = 'Resampling';
            $analisa_mikro->save();
        }
        else
        {
            $analisa_mikro_head_id          = resourceController::dekripsi($request->analisa_mikro_head_id);
            $analisa_mikro                  = analisaMikro::find($analisa_mikro_head_id);
            $analisa_mikro->status_analisa  = 'OK';
            $analisa_mikro->save();
        }
        return redirect()->route('analisa-mikro');
    }
    public function lihatAnalisaMikro($id_analisa_mikro)
    {
        # code...
    }
    public function resamplingAnalisaMikro($analisa_mikro_id)
    {
        $hakAksesUserAplikasi       = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
        $hakAksesAplikasi           = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
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

        $analisa_mikro_id           = resourceController::dekripsi($analisa_mikro_id);
        $analisa_mikro              = analisaMikro::find($analisa_mikro_id);
        /*foreach ($analisa_mikro as $key => $value)
        {
            $datapalet                  = DB::connection('production_data')->select("SELECT * FROM palet where '".$data['jam_filling']."' BETWEEN `start` AND `end`");
        }*/
        return view('rollie.analisa-mikro-resampling',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'analisaMikro'=>$analisa_mikro]);

    }
    public function sortasi()
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
