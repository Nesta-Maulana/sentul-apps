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
    public function index(){
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
        foreach ($water as $w ) {
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
        $now = Carbon::today('Asia/Jakarta');
        $bagian = bagian::where('workcenter_id', $id)->get();
        foreach ($bagian as  $value) 
        {
            $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                    ->select('pengamatan.*','bagian.*')
                    ->where('pengamatan.id_bagian',$value->id)
                    ->whereDate('pengamatan.created_at',$tanggal)
                    ->first();
            $value->pengamatan = $pengamatanbagian;
        }
        $satuan = satuan::all();
        return [$bagian, $satuan];
    }

    public function editDatabase($id){
        $now = Carbon::today('Asia/Jakarta');
        $bagian = bagian::where('id', $id)->get();
        foreach ($bagian as  $value) 
        {
            $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                    ->select('pengamatan.*','bagian.*')
                    ->where('pengamatan.id_bagian',$value->id)
                    ->whereDate('pengamatan.created_at',$now)
                    ->first();
            $value->pengamatan = $pengamatanbagian;
        }
        
        return $bagian;
    }

    public function updateDatabase(Request $request){
        $now = Carbon::today('Asia/Jakarta');
        $pengamatan = pengamatan::where('id_bagian', $request->id)->whereDate('created_at', $now)->first();
        $pengamatan->nilai_meteran = $request->nilai;
        $pengamatan->save();
        return $now;
    }

    public function simpanDatabase(Request $request){
        $now = Carbon::today('Asia/Jakarta');
        pengamatan::create([
            'nilai_meteran' => $request->nilai,
            'user_id' => Session::get('login'),
            'id_bagian' => $request->idBagian,
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