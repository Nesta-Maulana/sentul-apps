<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\karyawan;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\bagian;
use DB;
use \Carbon\Carbon;
use Session;

class adminUtilityController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            // dd(Session::all());

            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'utility Online')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

    public function index(){
        return view('utilityOnline.admin.index', ['menus' => $this->menu, 'username' => $this->username]);
    }
    public function report(){
        // 51, 52, 53, 54
        $now = Carbon::now('Asia/Jakarta');
        $time = $now->toTimeString();
        if($time <= '05:59')
            {
                $date = Carbon::yesterday();
                $tomorrow = Carbon::today(); 
                $pengamatanbagian = penggunaan::selectRaw('sum(nilai)')->whereIn('id_bagian',['51', '52', '53', '54'])
                                        ->whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                        ->first();
                $plantUtility = penggunaan::where('id_bagian', '50')
                                    ->whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                    ->latest()
                                    ->first();
                $tglPenggunaan = Carbon::addDay(-2);
            }
            else
            {
                $date = Carbon::today();
                $tomorrow = Carbon::tomorrow();
                $pengamatanbagian =  penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian',['51', '52', '53', '54'])
                                        ->whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                        ->first();
                $plantUtility = penggunaan::selectRaw('sum(nilai) as nilai')
                                            ->where('id_bagian', '50')
                                            ->whereBetween('created_at', [$date->toDateString() . ' 06:00:00', $tomorrow->toDateString() . ' 05:59:59'])
                                            ->first();
                $tglPenggunaan = Carbon::yesterday();
            }
        $report = penggunaan::all();
        $bagian = bagian::all();
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $pengamatan = pengamatan::all();
        $pengamatanCount = penggunaan::count() + 1;
        $coolingTower = Bagian::where('id', '69')->first();
        $coolingTower->id_bagian = $coolingTower->id;
        $tglPenggunaan = $tglPenggunaan->toDateString();
        $coolingTower->tgl_penggunaan = $tglPenggunaan;
        if (!$plantUtility) {
            array_add($coolingTower, 'nilai', '0' - $pengamatanbagian->nilai);
        } else{
            array_add($coolingTower, 'nilai', $plantUtility->nilai - $pengamatanbagian->nilai);
        }
        array_add($report, $pengamatanCount, $coolingTower);
        return view('utilityOnline.admin.report', ['menus' => $this->menu, 'username' => $this->username, 'report' => $report, 'bagian' => $bagian, 'pengamatan' => $pengamatan, 'kategori' => $kategori,'workcenter' => $workcenter]);
    }
    public function reportDate($from, $to){
        $report = penggunaan::whereBetween('tgl_penggunaan', [ $from, $to])->get();
        $bagian = bagian::all();
        return [$report, $bagian];
    }
    public function detailReport($id, $tgl){
        return view('utilityOnline.admin.detailReport', ['menus' => $this->menu, 'username' => $this->username]);
    }
}
