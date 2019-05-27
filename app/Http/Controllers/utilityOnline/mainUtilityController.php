<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\userAccess\userAccess;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\kategoriPencatatan;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\satuan;
use App\Models\masterApps\karyawan;
use DB;
use \Carbon\Carbon;
use Session;

class mainUtilityController extends Controller
{
    private $username;

    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            $this->user = resolve('usersData');
            
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            $this->username =  $this->username->fullname;
            return $next($request);
        });
    }
    public function index()
    {
        $kategori = kategori::all();
        $now = Carbon::today('Asia/Jakarta');
        
        $workcenter  = workcenter::all();
        $gas = bagian::join('workcenter', 'bagian.workcenter_id', '=', 'workcenter.id')
                    ->join('kategori', 'workcenter.kategori_id', '=', 'kategori.id')
                    ->where('kategori.id', '3')
                    ->select('bagian.*')
                    ->get();
        $listrik = bagian::join('workcenter', 'bagian.workcenter_id', '=', 'workcenter.id')
                    ->join('kategori', 'workcenter.kategori_id', '=', 'kategori.id')
                    ->where('kategori.id', '2')
                    ->select('bagian.*')
                    ->get();
        $water = bagian::join('workcenter', 'bagian.workcenter_id', '=', 'workcenter.id')
                    ->join('kategori', 'workcenter.kategori_id', '=', 'kategori.id')
                    ->where('kategori.id', '1')
                    ->select('bagian.*')
                    ->get();
        $kategoriPencatatan = kategoriPencatatan::all();
        foreach ($water as $w ) 
        {
            $nilai = pengamatan::where('id_bagian', $w->id)->whereDate('created_at', $now)->first();
            if($nilai){
                $w->pengamatan = $nilai->nilai_meteran;
            }else{
                $w->pengamatan = null;
            }
        }
        foreach ($listrik as $l ) {
            $nilai = pengamatan::where('id_bagian', $l->id)->whereDate('created_at', $now)->first();
            if($nilai){
                $l->pengamatan = $nilai->nilai_meteran;
            }else{
                $l->pengamatan = null;
            }
        }
        foreach ($gas as $g ) {
            $nilai = pengamatan::where('id_bagian', $g->id)->whereDate('created_at', $now)->first();
            if($nilai){
                $g->pengamatan = $nilai->nilai_meteran;
            }else{
                $g->pengamatan = null;
            }
        }
        
        return view('utilityOnline.operator.index', ['username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'kategoriPencatatan' => $kategoriPencatatan, 'water' => $water, 'gas' => $gas, 'listrik' => $listrik,]);
    }
    public function water(){
        $workcenter = workcenter::where('kategori_id', '1')->get();
        $bagian = bagian::all();
        return view("utilityOnline.operator.water", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username, 'id' => '']);
    }
    public function waterId($id){
        $workcenter = workcenter::where('kategori_id', '1')->get();
        $bagian = bagian::all();
        return view("utilityOnline.operator.water", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username, 'id' => $id]);
    }
    public function bagianSimpan(Request $request){
        $now = Carbon::now('Asia/Jakarta');
        $time = $now->toTimeString();
        $pengamatan = bagian::where('id', $request->idBagian)->latest()->first();
        if ($pengamatan->kategori_pencatatan_id == '1') {
            // Cek Waktu
            if($time > '06:00'){
                $tanggalSekarang =  Carbon::today('Asia/Jakarta');
                $tanggalBesok =  Carbon::tomorrow('Asia/Jakarta');
            }else{
                $tanggalSekarang =  Carbon::yesterday('Asia/Jakarta');
                $tanggalBesok =  Carbon::today('Asia/Jakarta');
            }
            $cekCoolingTower = penggunaan::where('id_bagian', '69')->whereBetween('created_at', [$tanggalSekarang . ' 06:00:00', $tanggalBesok . ' 05:59:59']);
            $cekDeminWaterProduksiNfi = penggunaan::where('id_bagian', '117')->whereBetween('created_at', [$tanggalSekarang . ' 06:00:00', $tanggalBesok . ' 05:59:59']);
            $cekSoftWaterNfi = penggunaan::where('id_bagian', '118')->whereBetween('created_at', [$tanggalSekarang . ' 06:00:00', $tanggalBesok . ' 05:59:59']);
            $cekNfiProduksi = penggunaan::where('id_bagian', '119')->whereBetween('created_at', [$tanggalSekarang . ' 06:00:00', $tanggalBesok . ' 05:59:59']);

            // Plant Utility
            if($request->idBagian == '50'){
                    if($cekCoolingTower->count() == '0'){
                        penggunaan::create([
                            'id_bagian' => '69',
                            'nilai' => $request->input,
                            'tgl_penggunaan' => $tanggalSekarang
                        ]);
                    } else{
                        $penggunaan = $cekCoolingTower->first();
                        $penggunaan->nilai = $penggunaan->nilai + $request->input;
                        $penggunaan->save();
                    }
            }
            // Plant Chiller, Boiler, Compesasor
            else if ($request->idBagian == '51' || $request->idBagian == '52' || $request->idBagian == '53' || $request->idBagian == '54'){
                if($cekCoolingTower->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '69',
                        'nilai' => '-' . $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekCoolingTower->first();
                    $penggunaan->nilai = $penggunaan->nilai - $request->input;
                    $penggunaan->save();
                }
            }
            // Demin Water
            else if($request->idBagian == '88'){
                if($cekDeminWaterProduksiNfi->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '117',
                        'nilai' => $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekDeminWaterProduksiNfi->first();
                    $penggunaan->nilai = $penggunaan->nilai + $request->input;
                    $penggunaan->save();
                }
            }
            // Demin Water Boiler, Demin Water HB, Demin Water Ruby
            else if ($request->idBagian == '89' || $request->idBagian == '90' || $request->idBagian == '91' ){
                if($cekDeminWaterProduksiNfi->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '117',
                        'nilai' => '-' . $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekDeminWaterProduksiNfi->first();
                    $penggunaan->nilai = $penggunaan->nilai - $request->input;
                    $penggunaan->save();
                }
            }
            // Soft Water Produksi NFI
            else if($request->idBagian == '92' || $request->idBagian == '93'){
                if($cekSoftWaterNfi->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '118',
                        'nilai' => $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekSoftWaterNfi->first();
                    $penggunaan->nilai = $penggunaan->nilai + $request->input;
                    $penggunaan->save();
                }
            }
            // Soft Water Ruby, Non Produksi, Gedung Depan, kantin, lubrikasi, cooling tower
            else if ($request->idBagian == '94' || $request->idBagian == '95' || $request->idBagian == '96' || $request->idBagian == '97' || $request->idBagian == '98' || $request->idBagian == '99' || $request->idBagian == '100' || $request->idBagian == '102'){
                if($cekSoftWaterNfi->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '118',
                        'nilai' => '-' . $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekSoftWaterNfi->first();
                    $penggunaan->nilai = $penggunaan->nilai - $request->input;
                    $penggunaan->save();
                }
            }
            // NFI Produksi -> workcenter gas(steam)
            else if($request->idBagian == '112'){
                if($cekNfiProduksi->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '119',
                        'nilai' => $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekNfiProduksi->first();
                    $penggunaan->nilai = $penggunaan->nilai + $request->input;
                    $penggunaan->save();
                }
            }
            // HNI Ruby
            else if ($request->idBagian == '113'){
                if($cekNfiProduksi->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => '119',
                        'nilai' => '-' . $request->input,
                        'tgl_penggunaan' => $tanggalSekarang
                    ]);
                } else{
                    $penggunaan = $cekNfiProduksi->first();
                    $penggunaan->nilai = $penggunaan->nilai - $request->input;
                    $penggunaan->save();
                }
            }


            // Input Pengamatan dan penggunaan
            $pengamatanbagian = pengamatan::where('id_bagian', $request->idBagian)->latest()->first();
            if($pengamatanbagian){
                $nilai = $pengamatanbagian->nilai_meteran - $request->input;
            }else{
                $nilai = $request->input;
            }
            pengamatan::create([
                'id_bagian' => $request->idBagian,
                'nilai_meteran' => $request->input,
                'user_id' => Session::get('login'),
            ]);
            $yesterday = Carbon::yesterday('Asia/Jakarta');
            
            penggunaan::create([
                'id_bagian' => $request->idBagian,
                'nilai' => $nilai,
                'tgl_penggunaan' => $yesterday
            ]);

            
        }else if ($pengamatan->kategori_pencatatan_id == '2'){
            $now = Carbon::now('Asia/Jakarta');
            $now = $now->toTimeString();
            if($now <= '05:59')
                {
                    $date = Carbon::yesterday();
                    $tomorrow = Carbon::today(); 
                    $pengamatanbagian = pengamatan::whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                        ->where('id_bagian', $request->idBagian);
                    $date = Carbon::today()->addDay('-2');
                }
                else
                {
                    $date = Carbon::today();
                    $tomorrow = Carbon::tomorrow();
                    $pengamatanbagian = pengamatan::whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                        ->where('id_bagian', $request->idBagian);
                    $date = Carbon::today()->addDay('-1');
                }
                if($pengamatanbagian->count() == '0'){
                    penggunaan::create([
                        'id_bagian' => $request->idBagian,
                        'nilai' => $request->input,
                        'tgl_penggunaan' => $date
                    ]);
                }else if($pengamatanbagian->count() >= '1' && $pengamatanbagian->count() <= '3' ){
                    $penggunaan = penggunaan::whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                    ->where('id_bagian', $request->idBagian);
                    $hasil = $request->input + $penggunaan->sum('nilai');
                    $penggunaan->first()->update([
                        'nilai' => $hasil,
                    ]);
                }
                pengamatan::create([
                    'id_bagian' => $request->idBagian,
                    'nilai_meteran' => $request->input,
                    'user_id' => Session::get('login'),
                ]);
        }

        return ['asdf'];
    }
    public function listrik(){
        $workcenter = workcenter::all();
        $workcenter = workcenter::where('kategori_id', '2')->get();
        return view('utilityOnline.operator.listrik', ['username' => $this->username, 'workcenter' => $workcenter, 'id' => '']);
    }
    public function listrikId($id){
        $workcenter = workcenter::where('kategori_id', '2')->get();
        $bagian = bagian::all();
        return view("utilityOnline.operator.listrik", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username, 'id' => $id]);
    }
    public function database(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        $pengamatan = pengamatan::all();
        return view("utilityOnline.operator.database", ['username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'bagian' => $bagian, 'pengamatan' => $pengamatan]);
    }
    public function databaseWorkcenter($id){
        $workcenter = workcenter::where('kategori_id', $id)->get();
        return $workcenter;
    }

    public function databaseBagian($id, $tanggal){
        $now = Carbon::now('Asia/Jakarta');
        $time = $now->toTimeString();
        $tomorrow = Carbon::tomorrow('Asia/Jakarta');
        $date = $now->toDateString();
        $bagian = bagian::where('workcenter_id', $id)->get();
        foreach ($bagian as  $value)  
        {
            if ($value->kategori_pencatatan_id == '2') 
            {
                $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                            ->select('bagian.*','pengamatan.*','pengamatan.id as pengamatan_id')
                                            ->where('pengamatan.id_bagian',$value->id)
                                            ->whereDate('pengamatan.created_at',$tanggal)
                                            ->get();
                // dd($pengamatanbagian);
                $shift1 = 0;
                $shift2 = 0;
                $shift3 = 0;
                foreach ($pengamatanbagian as $pengamatan) 
                {
                    $create = explode(' ',$pengamatan->created_at);
                    $time   = $create[1];
                    if($time >= '06:00' && $time <= '13:59')
                    {
                        
                        $shift1++;
                        $pengamatan->bagian = $value->bagian." Shift 1";
                    }
                    else if($time >= '14:00' && $time <= '21:59')
                    {
                        $shift2++;
                        $pengamatan->bagian = $value->bagian." Shift 2";
                    }
                    else if($time >= '22:00' || $time <= '05:59')
                    {
                        $shift3++;
                        $pengamatan->bagian = $value->bagian." Shift 3";
                    }
                }
                // dd($pengamatanbagian);
                if($shift1 == 0 && $shift2 == 0 && $shift3==0)
                {
                    
                }
                else if($shift1 == 0 && $shift2 == 0)
                {
                    
                }
                else if($shift1 == 0 && $shift3 == 0)
                {

                }
                else if($shift3 == 0 && $shift2 == 0)
                {  
                    // $pengamatan->
                    // array_add($pengamatanbagian, );
                }
                else if ($shift1 == 0) 
                {
                    
                }
                else if ($shift2 == 0) 
                {
                    
                }
                else if ($shift3 == 0)
                {
                    
                }
                else 
                {
                    
                }
            }
            else if($value->kategori_pencatatan_id == '1')
            {
                $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                ->select('pengamatan.*','bagian.*','pengamatan.id as pengamatan_id')
                ->where('pengamatan.id_bagian',$value->id)
                ->whereDate('pengamatan.created_at',$tanggal)
                ->get();
                foreach ($pengamatanbagian as $pengamatan) 
                {
                    $pengamatan->bagian = $value->bagian;
                }
            }
            $value->pengamatan = $pengamatanbagian;
        }

        $satuan = satuan::all();
        return [$bagian, $satuan];
    }

    public function editDatabase($id, $tgl){
        $pengamatan = pengamatan::where('id', $id)->get();
        foreach ($pengamatan as $p ) {
            $pengamatanbagian = bagian::rightjoin('pengamatan', 'pengamatan.id_bagian', 'bagian.id')
                                            ->select('bagian.bagian', 'pengamatan.*')
                                            ->where('pengamatan.id',$id)
                                            ->first();
            $p->bagian = $pengamatanbagian;
        }
        return $pengamatan;
    }

    public function updateDatabase(Request $request){
        $pengamatanbagian = pengamatan::where('id', $request->id)->latest()->first();
        $now = Carbon::today('Asia/Jakarta');
        $time = $now->toTimeString();
        $pengamatan = pengamatan::where('id', $request->id)->whereDate('created_at', $request->tgl)->first();
        $pengamatan->nilai_meteran = $request->nilai;
        $pengamatan->created_at = $request->tgl . ' ' . $time;
        $pengamatan->user_update = $now;
        $pengamatan->save();

        $penggunaan = penggunaan::where('id_bagian', $pengamatan->id_bagian)->latest()->first();
        $nilai = $penggunaan->nilai + $pengamatanbagian->nilai_meteran;
        $nilai = $nilai - $request->nilai;
        $penggunaan->nilai = $nilai;
        $penggunaan->save();
        return $now;
    }

    public function simpanDatabase(Request $request){
        
        $pengamatanbagian = pengamatan::where('id_bagian', $request->idBagian)->latest()->first();

        $now = Carbon::now('Asia/Jakarta');
        $time = $now->toTimeString();
        $pengamatan = new pengamatan();
        $pengamatan->nilai_meteran = $request->nilai;
        $pengamatan->user_id = Session::get('login');
        $pengamatan->id_bagian = $request->idBagian;
        $pengamatan->created_at = $request->tgl . ' ' . $time;
        $pengamatan->save(['timestamps' => false]);

        $yesterday = $pengamatan->created_at;
        $yesterday = $yesterday->toDateString();
        $yesterday = explode('-', $yesterday);
        $yesterday = Carbon::createFromDate($yesterday[0], $yesterday[1], $yesterday[2]);
        $yesterday = $yesterday->addDay('-1');
        $yesterday = $yesterday->toDateString();

        if($pengamatanbagian){
            $nilai = $pengamatanbagian->nilai_meteran - $request->nilai;
            
        }else{
            $nilai = $request->nilai;
        }
    
        penggunaan::create([
            'id_bagian' => $request->idBagian,
            'nilai' => $nilai,
            'tgl_penggunaan' => $yesterday
        ]);

        return $now;
    }

    public function gas(){
        $workcenter = workcenter::all();
        $workcenter = workcenter::where('kategori_id', '3')->get();
        return view('utilityOnline.operator.gas', ['username' => $this->username, 'workcenter' => $workcenter, 'id' => '']);
    }
    public function showInput($id){
        
        $bagian = bagian::where('workcenter_id', $id)->get();
        foreach ($bagian as  $value) 
        {
        
            $date = Carbon::today('Asia/Jakarta');
            $now = Carbon::now('Asia/Jakarta');
            $time = $now->toTimeString();
            if($value->kategori_pencatatan_id == '2'){
                
                if($time >= '06:00' && $time <= '13.59')
                {

                    $cek = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                    if($cek < 1)
                    {
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                    }else{
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at',$date)
                                                    ->first();
                    }
                }
                else if($time >= '14:00' && $time <= '21:59')
                {
                    
                    $cek = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                    if($cek < 2)
                    {
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                    }else if($cek == '2'){
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', $date)
                                                    ->orderBy('pengamatan.created_at', 'desc')
                                                    ->first();
                    }else{
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', $date)
                                                    ->get();
                        $pengamatanbagian  = $pengamatanbagian[1];
                    }
                }
                else if($time >= '22:00' || $time <= '05:59')
                {
                    $cek = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                    if($cek == '0')
                    { 
                        $date = Carbon::yesterday('Asia/Jakarta');
                        $cekLagi = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                        
                        if($cekLagi == '3')
                        {
                            $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                        }
                        else
                        {
                            $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                        }
                    }
                    else if($cek == '3')
                    {
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', $date)
                                                    ->orderBy('pengamatan.created_at', 'desc')
                                                    ->first();
                    }
                    else if($cek > '1' && $cek < '3')
                    {
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', $date)
                                                    ->orderBy('pengamatan.created_at', 'desc')
                                                    ->first();
                    }
                    else
                    {
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                    }
                }
            }
            else
            {
                if($time <= '05:59')
            
                {
                    $date = Carbon::yesterday();
                    $tomorrow = Carbon::today(); 
                    $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                            ->select('pengamatan.*','bagian.*')
                                            ->where('pengamatan.id_bagian',$value->id)
                                            ->whereBetween('pengamatan.created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                            ->first();
                }
                else
                {
                    $date = Carbon::today();
                    $tomorrow = Carbon::tomorrow();
                    $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                            ->select('pengamatan.*','bagian.*')
                                            ->where('pengamatan.id_bagian',$value->id)
                                            ->whereBetween('pengamatan.created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                            ->first();
                }
            }
            $value->pengamatan = $pengamatanbagian;
        }
        $satuan = satuan::all();
        return [$bagian, $satuan];
    }
    public function gasId($id){
        $workcenter = workcenter::all();
        $workcenter = workcenter::where('kategori_id', '3')->get();
        return view('utilityOnline.operator.gas', ['username' => $this->username, 'workcenter' => $workcenter, 'id' => $id]);
    }

    
}