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
use App\Models\productionData\analisaKimia;
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
        foreach ($cpps->analisaKimia as $key => $analisaKimia) 
        {
        
        }
        return view('rollie.analisa_kimia_analisa',['menus'=>$this->menu,'username'=>$this->username,'hakAkses'=>$data,'cpps'=>$cpps]);
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
            if (is_null($analisa_kimia_id)) 
            {
                // ini tambah baru
            }
            else
            {
                // ini update
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
                if (( strpos($ambil_palet,"Awal") !== false && strpos($ambil_palet,"Akhir") !== false ) || strpos($ambil_palet,"Tengah") !== false ) 
                {
                    
                }
            }
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
