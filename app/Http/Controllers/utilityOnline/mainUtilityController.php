<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\kategoriPencatatan;
use App\Models\utilityOnline\penggunaan;
use App\Models\masterApps\karyawan;
use DB;
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
        $now = \Carbon\Carbon::today('Asia/Jakarta');
        $workcenter  = workcenter::all();
        $gas = bagian::join('workcenter', 'bagian.workcenter_id', '=', 'workcenter.id')
                    ->join('kategori', 'workcenter.kategori_id', '=', 'kategori.id')
                    ->where('kategori.id', '3')
                    ->select('bagian.*', 'kategori.id')
                    ->get();
        $listrik = bagian::join('workcenter', 'bagian.workcenter_id', '=', 'workcenter.id')
                    ->join('kategori', 'workcenter.kategori_id', '=', 'kategori.id')
                    ->where('kategori.id', '2')
                    ->select('bagian.*', 'kategori.id')
                    ->get();
        $water = bagian::join('workcenter', 'bagian.workcenter_id', '=', 'workcenter.id')
                    ->join('kategori', 'workcenter.kategori_id', '=', 'kategori.id')
                    ->where('kategori.id', '1')
                    ->select('bagian.*', 'kategori.id')
                    ->get();
        $kategoriPencatatan = kategoriPencatatan::all();
        foreach ($water as $w ) {
            $w->pengamatan = pengamatan::whereDate('created_at', $now)->get();
        }
        foreach ($listrik as $l ) {
            $l->pengamatan = pengamatan::whereDate('created_at', $now)->get();
        }
        foreach ($gas as $g ) {
            $g->pengamatan = pengamatan::whereDate('created_at', $now)->get();
        }
        return view('utilityOnline.index', ['username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'kategoriPencatatan' => $kategoriPencatatan, 'water' => $water, 'gas' => $gas, 'listrik' => $listrik,]);
    }
    public function water(){
        $workcenter = workcenter::where('kategori_id', '1')->get();
        $bagian = bagian::all();
        return view("utilityOnline.water", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username, 'id' => '']);
    }
    public function waterId($id){
        $workcenter = workcenter::where('kategori_id', '1')->get();
        $bagian = bagian::all();
        return view("utilityOnline.water", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username, 'id' => $id]);
    }
    public function bagianSimpan(Request $request){
        $pengamatan = pengamatan::where('id_bagian', $request->idBagian)->latest()->first();

        if($pengamatan){
            $nilai = $pengamatan->nilai_meteran - $request->input;
        }else{
            $nilai = $request->input;
        }
        pengamatan::create([
            'id_bagian' => $request->idBagian,
            'nilai_meteran' => $request->input,
            'user_id' => Session::get('login'),
        ]);
        $yesterday = \Carbon\Carbon::yesterday('Asia/Jakarta');
        
        penggunaan::create([
            'id_bagian' => $request->idBagian,
            'nilai' => $nilai,
            'tgl_penggunaan' => $yesterday
        ]);
        return ['asdf'];
    }
    // public function waterWorkcenter($id){
    //     $now = \Carbon\Carbon::today('Asia/Jakarta');
    //     // $bagian = bagian::where('workcenter_id', $id)->get();
    //     // $pengamatan = pengamatan::whereDate('created_at', $now)->get();
    //     // $output = [$pengamatan, $bagian];
    //     $bagian = bagian::where('workcenter_id', $id)->get();
    //     foreach ($bagian as  $value) 
    //     {
    //         $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
    //                 ->select('pengamatan.*','bagian.*')
    //                 ->where('pengamatan.id_bagian',$value->id)
    //                 ->whereDate('pengamatan.created_at',$now)
    //                 ->first();
    //         $value->pengamatan = $pengamatanbagian;
    //     }
    //     return $bagian;
    // }

    public function listrik(){
        $workcenter = workcenter::all();
        $workcenter = workcenter::where('kategori_id', '2')->get();
        return view('utilityOnline.listrik', ['username' => $this->username, 'workcenter' => $workcenter, 'id' => '']);
    }

    // public function listrikWorkcenter($id){
    //     $now = \Carbon\Carbon::today('Asia/Jakarta');
    //     // $bagian = bagian::where('workcenter_id', $id)->get();
    //     // $pengamatan = pengamatan::whereDate('created_at', $now)->get();
    //     // $output = [$pengamatan, $bagian];
    //     $bagian = bagian::where('workcenter_id', $id)->get();
    //     foreach ($bagian as  $value) 
    //     {
    //         $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
    //                 ->select('pengamatan.*','bagian.*')
    //                 ->where('pengamatan.id_bagian',$value->id)
    //                 ->whereDate('pengamatan.created_at',$now)
    //                 ->first();
    //         $value->pengamatan = $pengamatanbagian;
    //     }
        
    //     return $bagian;
    // }
    public function listrikId($id){
        $workcenter = workcenter::where('kategori_id', '2')->get();
        $bagian = bagian::all();
        return view("utilityOnline.listrik", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username, 'id' => $id]);
    }
    public function database(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        return view("utilityOnline.database", ['username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'bagian' => $bagian]);
    }
    public function databaseWorkcenter($id){
        $workcenter = workcenter::where('kategori_id', $id)->get();
        return $workcenter;
    }

    public function databaseBagian($id, $tanggal){
        $now = \Carbon\Carbon::today('Asia/Jakarta');
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
        
        return $bagian;
    }

    public function editDatabase($id){
        $now = \Carbon\Carbon::today('Asia/Jakarta');
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
        $now = \Carbon\Carbon::today('Asia/Jakarta');
        $pengamatan = pengamatan::where('id_bagian', $request->id)->whereDate('created_at', $now)->first();
        // $pengamatan = $pengamatan::whereDate('created_at', $now);
        $pengamatan->nilai_meteran = $request->nilai;
        $pengamatan->save();
        return $now;
    }

    public function simpanDatabase(Request $request){
        $now = \Carbon\Carbon::today('Asia/Jakarta');
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
        return view('utilityOnline.gas', ['username' => $this->username, 'workcenter' => $workcenter, 'id' => '']);
    }
    public function showInput($id){
        
        $bagian = bagian::where('workcenter_id', $id)->get();
        foreach ($bagian as  $value) 
        {
        
            $date = \Carbon\Carbon::today('Asia/Jakarta');
            $now = \Carbon\Carbon::now('Asia/Jakarta');
            $time = $now->toTimeString();
            if($value->kategori_pencatatan_id == '2'){
                
                if($time >= '06:00' && $time <= '13.59'){

                    $cek = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                    if($cek < 1){
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
                }else if($time >= '14:00' && $time <= '21:59'){
                    
                    $cek = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                    if($cek < 2){
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
                    }
                }else if($time >= '22:00' || $time <= '05:59'){
                    
                    $cek = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                    
                    if($cek == '0'){ 
                        $date = \Carbon\Carbon::yesterday('Asia/Jakarta');
                        $cekLagi = pengamatan::where('id_bagian',$value->id)->whereDate('created_at', $date)->count();
                        
                        if($cekLagi == '3'){
                            $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                        }else{
                            $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                        }
                    }else if($cek == '3'){
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', $date)
                                                    ->orderBy('pengamatan.created_at', 'desc')
                                                    ->first();
                    }else if($cek == '1'){
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', $date)
                                                    ->orderBy('pengamatan.created_at', 'desc')
                                                    ->first();
                    }
                    
                    else{
                        $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                                    ->select('pengamatan.*','bagian.*')
                                                    ->where('pengamatan.id_bagian',$value->id)
                                                    ->whereDate('pengamatan.created_at', '31.02.2019')
                                                    ->first();
                    }
                }else{
                    dd($time);
                }
                
            }else{
                
                $pengamatanbagian = bagian::leftjoin('pengamatan','pengamatan.id_bagian','bagian.id')
                                            ->select('pengamatan.*','bagian.*')
                                            ->where('pengamatan.id_bagian',$value->id)
                                            ->whereDate('pengamatan.created_at',$date)
                                            ->first();
            }
            $value->pengamatan = $pengamatanbagian;
        }
        
        return $bagian;
    }
    public function gasId($id){
        $workcenter = workcenter::all();
        $workcenter = workcenter::where('kategori_id', '3')->get();
        return view('utilityOnline.gas', ['username' => $this->username, 'workcenter' => $workcenter, 'id' => $id]);
    }

    
}