<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\bagian;
use DB;
use Session;

class mainController extends Controller
{
    private $username;

    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            $this->username = resolve('usersData');
            $this->username =  $this->username->fullname;
            return $next($request);
        });
    }
    public function index(){
        return view('utilityOnline.index', ['username' => $this->username]);
    }
    public function water(){
        $workcenter = workcenter::where('kategori_id', '1')->get();
        $bagian = bagian::all();
        return view("utilityOnline.water", ['workcenter' => $workcenter, 'bagian' => $bagian, 'username' => $this->username]);
    }
    public function waterSimpan(Request $request){
        // $now = \Carbon\Carbon::now('Asia/Jakarta')->format('d-m-Y');
        // $bagian = response()->json($request->idBagian);
        // $input = response()->json($request->input);
        
        pengamatan::create([
            'id_bagian' => $request->idBagian,
            'nilai_meteran' => $request->input,
            'user_id' => Session::get('login'),
        ]);
        return ['asdf'];
    }
    public function waterWorkcenter($id){
        $now = \Carbon\Carbon::today('Asia/Jakarta');
        // $bagian = bagian::where('workcenter_id', $id)->get();
        // $pengamatan = pengamatan::whereDate('created_at', $now)->get();
        // $output = [$pengamatan, $bagian];
        $bagian = bagian::where('workcenter_id', $id)->get();
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

    public function listrik(){
        $workcenter = workcenter::all();
        $workcenter = workcenter::where('kategori_id', '2')->get();
        return view('utilityOnline.listrik', ['username' => $this->username, 'workcenter' => $workcenter]);
    }

    public function listrikWorkcenter($id){
        $now = \Carbon\Carbon::today('Asia/Jakarta');
        // $bagian = bagian::where('workcenter_id', $id)->get();
        // $pengamatan = pengamatan::whereDate('created_at', $now)->get();
        // $output = [$pengamatan, $bagian];
        $bagian = bagian::where('workcenter_id', $id)->get();
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
    public function listrikSimpan( Request $request ){
        pengamatan::create([
            'id_bagian' => $request->idBagian,
            'nilai_meteran' => $request->input,
            'user_id' => Session::get('login'),
        ]);
        return ['Berhasil'];
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
        return view('utilityOnline.gas', ['username' => $this->username, 'workcenter' => $workcenter]);
    }
    public function gasWorkcenter($id){
        $now = \Carbon\Carbon::today('Asia/Jakarta');
        $bagian = bagian::where('workcenter_id', $id)->get();
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
    public function gasSimpan(Request $request){
        pengamatan::create([
            'id_bagian' => $request->idBagian,
            'nilai_meteran' => $request->input,
            'user_id' => Session::get('login'),
        ]);
        return ['Berhasil'];
    }
    
}