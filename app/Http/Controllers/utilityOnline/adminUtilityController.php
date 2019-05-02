<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use Illuminate\Database\Eloquent\Collection;
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

class adminUtilityController extends resourceController
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
        $report = penggunaan::orderBy('tgl_penggunaan', 'desc')->get();
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
            // $coolingTower = collect(['nilai' => $plantUtility->nilai - $pengamatanbagian->nilai]) + $coolingTower;
            array_add($coolingTower, 'nilai', $plantUtility->nilai - $pengamatanbagian->nilai);
        }
        array_add($report, $pengamatanCount, $coolingTower);
        // dd($report);
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
    public function report3Tgl($tgl){
        if(penggunaan::whereIn('id_bagian', ['70', '71'])->where('tgl_penggunaan', $tgl)->first()){
            $a = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['70', '71'])->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $a = 0;
        }
        if(penggunaan::where('id_bagian', '70')->where('tgl_penggunaan', $tgl)->first()){
            $lbwp = penggunaan::where('id_bagian', '70')->where('tgl_penggunaan', $tgl)->first()->nilai / $a * 100;
        }else{
            $lbwp = 0;
        }
        if(penggunaan::where('id_bagian', '58')->where('tgl_penggunaan', $tgl)->first()){
            $lpgp = penggunaan::where('id_bagian', '58')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $lpgp =0;
        }
        if(penggunaan::where('id_bagian', '71')->where('tgl_penggunaan', $tgl)->first()){
            $wbp = penggunaan::where('id_bagian', '71')->where('tgl_penggunaan', $tgl)->first()->nilai / $a * 100;
        }else{
            $wbp = 0;
        }
        if(penggunaan::where('id_bagian', '37')->where('tgl_penggunaan', $tgl)->first()){
           $ups1 =  penggunaan::where('id_bagian', '37')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $ups1 = 0;
        }
        if(penggunaan::whereIn('id_bagian', ['38', '39', '72', '73'])->where('tgl_penggunaan', $tgl)->first()){
            $ups2 = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['38', '39', '72', '73'])->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $ups2 = 0;
        }
        if(penggunaan::whereIn('id_bagian', ['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'])->where('tgl_penggunaan', $tgl)->first()){
            $nfiTotal = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'])->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $nfiTotal = 0;
        }
        if(penggunaan::where('id_bagian', '38')->where('tgl_penggunaan', $tgl)->first()){
            $frc1 = penggunaan::where('id_bagian', '38')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $frc1 = 0;
        }
        if(penggunaan::whereIn('id_bagian', ['72', '73'])->where('tgl_penggunaan', $tgl)->first()){
            $frc2 = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['72', '73'])->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $frc2 = 0;
        }
        if(penggunaan::where('id_bagian', '39')->where('tgl_penggunaan', $tgl)->first()){
            $lab = penggunaan::where('id_bagian', '39')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $lab = 0;
        }
        if(penggunaan::where('id_bagian', '55')->where('tgl_penggunaan', $tgl)->first()){
            $ac1 = penggunaan::where('id_bagian', '55')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $ac1 = 0;
        }
        if(penggunaan::where('id_bagian', '56')->where('tgl_penggunaan', $tgl)->first()){
            $ac2 = penggunaan::where('id_bagian', '56')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $ac2 = 0;
        }
        if(penggunaan::where('id_bagian', '48')->where('tgl_penggunaan', $tgl)->first()){
            $rc1 = penggunaan::where('id_bagian', '48')->where('tgl_penggunaan', $tgl)->first()->nilai / 4;
        }else{
            $rc1 = 0;
        }
        if(penggunaan::where('id_bagian', '46')->where('tgl_penggunaan', $tgl)->first()){
            $hydrant = penggunaan::where('id_bagian', '46')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $hydrant = 0;
        }
        if(penggunaan::whereIn('id_bagian', ['72', '73'])->where('tgl_penggunaan', $tgl)->first()){
            $ruby = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['72', '73'])->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $ruby = 0;
        }
        if(penggunaan::where('id_bagian','43')->where('tgl_penggunaan', $tgl)->first()){
            $greek = penggunaan::where('id_bagian','43')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $greek = 0;
        }
        if(penggunaan::where('id_bagian','57')->where('tgl_penggunaan', $tgl)->first()){
            $bakery = penggunaan::where('id_bagian','57')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $bakery = 0;
        }
        if(penggunaan::where('id_bagian','42')->where('tgl_penggunaan', $tgl)->first()){
            $officeRd = penggunaan::where('id_bagian','42')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $officeRd = 0;
        }
        if(penggunaan::where('id_bagian','6')->where('tgl_penggunaan', $tgl)->first()){
            $acGudang = penggunaan::where('id_bagian','6')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $acGudang = 0;
        }
        if(penggunaan::where('id_bagian','49')->where('tgl_penggunaan', $tgl)->first()){
            $rcHni = penggunaan::where('id_bagian','49')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $rcHni = 0;
        }
        if(penggunaan::where('id_bagian','48')->where('tgl_penggunaan', $tgl)->first()){
            $rc = $rcHni + penggunaan::where('id_bagian', '48')->where('tgl_penggunaan', $tgl)->first()->nilai * 3 / 4;
        }else{
            $rc = 0;
        }
        if(penggunaan::where('id_bagian','51')->where('tgl_penggunaan', $tgl)->first()){
            $boiler = penggunaan::where('id_bagian', '51')->where('tgl_penggunaan', $tgl)->first()->nilai * 3 / 4;
        }else{
            $boiler = 0;
        }
        if(penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['52', '53'])->where('tgl_penggunaan', $tgl)->first()){
            $chiller = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['52', '53'])->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $chiller = 0;
        }
        if(penggunaan::where('id_bagian', '54')->where('tgl_penggunaan', $tgl)->first()){
            $compressor = penggunaan::where('id_bagian', '54')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $compressor = 0;
        }
        if(penggunaan::where('id_bagian', '69')->where('tgl_penggunaan', $tgl)->first()){
            $coolingTowers = penggunaan::where('id_bagian', '69')->where('tgl_penggunaan', $tgl)->first()->nilai;
        }else{
            $coolingTowers = 0;
        }
        if(penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['51', '52', '53', '54'])->where('tgl_penggunaan', $tgl)->first()){
            $coolingTower = penggunaan::selectRaw('sum(nilai) as nilai')->whereIn('id_bagian', ['51', '52', '53', '54'])->where('tgl_penggunaan', $tgl)->first()->nilai;
            $coolingTower = $coolingTowers - $coolingTower;
        }else{
            $coolingTower = $coolingTowers;
        }
        $frc = $frc1 - $frc2;
        $ups = $ups1 - $ups2;
        
        if($frc + $ruby == 0){
            $fr = 1;
        }else{
            $fr = $frc + $ruby;
        }
        if($ruby + $greek + $frc == 0){
            $rgf = 1;
        }else{
            $rgf = $ruby + $greek + $frc;
        }
        
        $bagian = [ '0' => ['bagian' => 'PLN', 'nilai' => $a * 3.2, 'satuan' => 'Mwh'], //PLN 
                    '1' => ['bagian' => 'LWBP', 'nilai' => $lbwp, 'satuan' => '%'], // LBWP
                    '2' => ['bagian' => 'WBP', 'nilai' => $wbp,  'satuan' => '%'], // WBP
                    '3' => ['bagian' => 'UPS Charging', 'nilai' => $ups, 'satuan' => 'Mwh'],
                    '4' => ['bagian' => 'NFI TOTAl', 'nilai' => $nfiTotal, 'satuan' => 'Mwh'],
                    '5' => ['bagian' => 'FRC', 'nilai' => $frc, 'satuan' => 'Mwh'],
                    '6' => ['bagian' => 'UPS FRC', 'nilai' => ($frc/$fr)* $ups, 'satuan' => 'Mwh'],
                    '7' => ['bagian' => 'LAB', 'nilai' => $lab, 'satuan' => 'Mwh'],
                    // 'WTP & WWTP'
                    '8' => ['bagian' => 'LPGP', 'nilai' => $lpgp, 'satuan' => 'Mwh'],
                    '9' => ['bagian' => 'AC', 'nilai' => $ac1 - $ac2, 'satuan' => 'Mwh'],
                    '10' =>  ['bagian' => 'RC', 'nilai' => $rc1, 'satuan' => 'Mwh'],
                    '11' => ['bagian' => 'HYDRANT', 'nilai' => $hydrant, 'satuan' => ''],
                    // 'DEEPWELL' => penggunaan::where
                    // 'UTILITY TOTAL'
                    // 'Boiler'
                    '12' =>  ['bagian' => 'Chiller', 'nilai' => $chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller, 'satuan' => ''],
                    '13' => ['bagian' => 'Compressor', 'nilai' => $compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor), 'satuan' => ''],
                    '14' => ['bagian' => 'Cooling Tower', 'nilai' => $coolingTower, 'satuan' => ''],
                    // 'HNI TOTAL'
                    // 'PRODUKSI'
                    '15' => ['bagian' => 'RUBY', 'nilai' => $ruby, 'satuan' => 'Mwh'],
                    '16' => ['bagian' => 'UPS RUBY', 'nilai' => ($ruby / $fr) * $ups, 'satuan' => 'Mwh'],
                    '17' => ['bagian' => 'GREEK', 'nilai' => $greek, 'satuan' => 'Mwh'],
                    '18' => ['bagian' => 'BAKERY', 'nilai' => $bakery, 'satuan' => 'Mwh'],
                    '19' => ['bagian' => 'OFFICE-RD', 'nilai' => $officeRd, 'satuan' => 'Mwh'],
                    '20' => ['bagian' => 'AC GUDANG', 'nilai' => $acGudang, 'satuan' => 'Mwh'],
                    // 'WTP & WWTP'
                    // 'RUBY'
                    // 'GREEK'
                    // 'Non-Produksi'
                    '21' => ['bagian' => 'RC', 'nilai' => $rc, 'satuan' => 'Mwh'],
                    // 'DEEPWELL'
                    // 'UTILITY'
                    // 'RUBY Utility'
                    // 'Boiler' => ($ruby/$rgf) * $chiller,
                    '22' => ['bagian' => 'Chiller', 'nilai' => ($ruby/$rgf) * $chiller, 'satuan' => 'Mwh'],
                    '23' => ['bagian' => 'Compressor', 'nilai' => ($ruby/$rgf) * $compressor, 'satuan' => 'Mwh'],
                    '24' => ['bagian' => 'Colling Tower', 'nilai' => ($ruby/$rgf) * $coolingTower, 'satuan' => 'Mwh'],
                    // 'GREEK  Utility'
                    // 'Boiler'

                    '25' => ['bagian' => 'Chiller', 'nilai' => ($greek/$rgf) * $chiller, 'satuan' => 'Mwh'],
                    '26' => ['bagian' => 'Compressor', 'nilai' => ($greek/$rgf) * $compressor, 'satuan' => 'Mwh'],
                    '27' => ['bagian' => 'Colling Tower', 'nilai' => ($greek/$rgf) * ($greek/$rgf) * $coolingTower, 'satuan' => 'Mwh'],
        ];
        return $bagian;
        
    }
    public function report4Tgl($tgl){
        $bagian = ['0' => ['bagian' => 'NFI VAR.LOAD'],
                    '1' => ['bagian' => 'NFI FIX.LOAD'],
                    '2' => ['bagian' => 'HNI VAR.LOAD'],
                    '3' => ['bagian' => 'HNI FIX.LOAD'],
                    ];
        return $bagian;
    }
}
