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
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\satuan;
use App\Models\utilityOnline\hariKerja;
use Illuminate\Support\Arr;
use \Carbon\Carbon;
use Session;
use DB;

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

    public function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }    

    public function rasioBagian($bagian, $company = "", $tgl)
    {
        $nilai = 0;
        $cek = penggunaan::whereIn('id_bagian', $bagian)->where('tgl_penggunaan', $tgl)->get();
        foreach ($cek as $penggunaan) 
        {
            if(!$penggunaan->bagian->rasioHead)
            {
                $nilaiBagian = $penggunaan->nilai;
                $nilai =  $nilai + $nilaiBagian;
            }
            else
            {
                foreach ($penggunaan->bagian->rasioHead->rasioDetail as $rasioDetail) 
                {                
                    if ($rasioDetail->company->singkatan == $company) 
                    {
                        $nilaiPenggunaan = $penggunaan->nilai;
                        $rasio = $rasioDetail->nilai/100;
                        $nilaiBagian = $penggunaan->nilai * $rasio;
                        $nilai =  $nilai + $nilaiBagian;
                    }
                    else
                    {
                        $nilaiBagian = $penggunaan->nilai;
                        $nilai =  $nilai + $nilaiBagian;
                    }
                }
            }
        }
            return $nilai;
    }
    
    public function index(){
        return view('utilityOnline.admin.index', ['menus' => $this->menu, 'username' => $this->username]);
    }
    public function hariKerja(){
        return view('utilityOnline.admin.hariKerja', ['menus' => $this->menu, 'username' => $this->username]);
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
        // dd($report[1]);
        foreach ($report as $r ) {
            $rasioHead = rasioHead::where('bagian_id', $r->id_bagian)->latest()->first();
            if($rasioHead){
                $nilai = [];
                $i = 0;
                foreach ($rasioHead->rasioDetail as $rd) {
                    array_push($nilai, $rd);
                    $i++;
                }
                if($i == 1){
                     if($nilai[0]->company_id != '1'){
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = $nilai[0]->nilai * $r->nilai / 100;
                        }
                    }else if($nilai[0]->company_id == '1'){
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_hni = '0';
                            $r->nilai_nfi = $nilai[0]->nilai * $r->nilai / 100;
                        }
                    }
                }else if($i < 1){
                    $r->nilai_nfi = '0';
                    $r->nilai_hni = '0';    
                }else{
                    if( $r->nilai == '0' ){
                        $r->nilai_nfi = '0';
                        $r->nilai_hni = '0';
                    }
                    else{
                        $r->nilai_nfi = $nilai[0]->nilai * $r->nilai / 100;
                        $r->nilai_hni = $nilai[1]->nilai * $r->nilai / 100;
                    }
                }
                
            }else{
                $r->nilai_nfi = '0';
                $r->nilai_hni = '0';    
            }
        }
        $bagian = bagian::all();
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $pengamatan = pengamatan::all();
        return view('utilityOnline.admin.report', ['menus' => $this->menu, 'username' => $this->username, 'report' => $report, 'bagian' => $bagian, 'pengamatan' => $pengamatan, 'kategori' => $kategori,'workcenter' => $workcenter]);
    }
    public function report2(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $pengamatan = pengamatan::all();
        return view('utilityOnline.admin.report2', ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'pengamatan' => $pengamatan]);
    }
    public function report3(){
        $kategori = kategori::all();
        return view('utilityOnline.admin.report3', ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori]);
    }
    public function report4(){
        $kategori = kategori::all();
        return view('utilityOnline.admin.report4', ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori]);
    }
    public function report5(){
        $kategori = kategori::all();
        return view('utilityOnline.admin.report5', ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori]);
    }
    public function reportGrafik(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        return view('utilityOnline.admin.reportGrafik', ['menus' => $this->menu, 'username' => $this->username,'kategori' => $kategori,'workcenter' => $workcenter,'bagian' => $bagian]);
    }
    public function ambilHariKerja($tgl = ""){

        return hariKerja::where('tgl', $tgl)->get();
    }
    public function ambilSemuaHariKerja(){

        return hariKerja::all();
    }

    public function reportBagian($id){
       return bagian::where('workcenter_id', $id)->get();
    }

    public function hariKerjaSave(Request $request){
        if($request->id){
            $hariKerja = hariKerja::find($request->id);
            $hariKerja->hni = $request->hni;
            $hariKerja->nfi = $request->nfi;
            $hariKerja->tonase = $request->tonase;
            $hariKerja->save();
        }else{
            hariKerja::create([
                'tgl' => $request->tgl,
                'hni' => $request->hni,
                'nfi' => $request->nfi,
                'tonase' => $request->tonase,
            ]);
        }
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function reportDate($from, $to){
        
        $rasioHead = rasioHead::all();        
        $report = penggunaan::whereBetween('tgl_penggunaan', [ $from, $to])->get();
        foreach ($report as $r ) {
            $rasioHead = rasioHead::where('bagian_id', $r->id_bagian)->latest()->first();
            if($rasioHead){
                $nilai = [];
                $i = 0;
                foreach ($rasioHead->rasioDetail as $rd) {
                    array_push($nilai, $rd);
                    $i++;
                }
                if($i == 1){
                    if($nilai[0]->company_id != '1'){
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_hni = '0';
                            $r->nilai_nfi = $nilai[0]->nilai / $r->nilai * 100;
                        }
                    }else{
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = $nilai[0]->nilai / $r->nilai * 100;
                        }   
                    }
                }else if($i < 1){
                    $r->nilai_nfi = '0';
                    $r->nilai_hni = '0';    
                }else{
                    if( $r->nilai == '0' ){
                        $r->nilai_nfi = '0';
                        $r->nilai_hni = '0';
                    }
                    else{
                        $r->nilai_nfi = $nilai[0]->nilai / $r->nilai * 100;
                        $r->nilai_hni = $nilai[1]->nilai / $r->nilai * 100;
                    }
                }
                
            }else{
                $r->nilai_nfi = '0';
                $r->nilai_hni = '0';    
            }
        }
        $bagian = bagian::all();
        
        return [$report, $bagian];
    }
    public function reportKategori($id){
        $rasioHead = rasioHead::all();
        $report = penggunaan::get();
        foreach ($report as $r ) {
            $rasioHead = rasioHead::where('bagian_id', $r->id_bagian)->latest()->first();
            if($rasioHead){
                $nilai = [];
                $i = 0;
                foreach ($rasioHead->rasioDetail as $rd) {
                    array_push($nilai, $rd);
                    $i++;
                }
                if($i == 1){
                    if($nilai[0]->company_id != '1'){
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_hni = '0';
                            $r->nilai_nfi = $nilai[0]->nilai / $r->nilai * 100;
                        }
                    }else{
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = $nilai[0]->nilai / $r->nilai * 100;
                        }   
                    }
                }else if($i < 1){
                    $r->nilai_nfi = '0';
                    $r->nilai_hni = '0';    
                }else{
                    if( $r->nilai == '0' ){
                        $r->nilai_nfi = '0';
                        $r->nilai_hni = '0';
                    }
                    else{
                        $r->nilai_nfi = $nilai[0]->nilai / $r->nilai * 100;
                        $r->nilai_hni = $nilai[1]->nilai / $r->nilai * 100;
                    }
                }
                
            }else{
                $r->nilai_nfi = '0';
                $r->nilai_hni = '0';    
            }
        }
        $bagian = bagian::join('workcenter',  'workcenter.id', 'bagian.workcenter_id')
                            ->join('kategori', 'kategori.id', 'workcenter.kategori_id')
                            ->select('bagian.*')
                            ->where('kategori.id', $id)->get();
        return [$report, $bagian];
    }
    public function reportKategoriDate($id, $from, $to){
        
        $rasioHead = rasioHead::all();        
        $report = penggunaan::whereBetween('tgl_penggunaan', [$from,$to])->get();
        // dd($report);
        foreach ($report as $r ) {
            $rasioHead = rasioHead::where('bagian_id', $r->id_bagian)->latest()->first();
            if($rasioHead){
                $nilai = [];
                $i = 0;
                foreach ($rasioHead->rasioDetail as $rd) {
                    array_push($nilai, $rd);
                    $i++;
                }
                if($i == 1){
                    if($nilai[0]->company_id != '1'){
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_hni = '0';
                            $r->nilai_nfi = $nilai[0]->nilai / $r->nilai * 100;
                        }
                    }else{
                        if( $r->nilai == '0' ){ 
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = '0';
                        }
                        else{
                            $r->nilai_nfi = '0';
                            $r->nilai_hni = $nilai[0]->nilai / $r->nilai * 100;
                        }   
                    }
                }else if($i < 1){
                    $r->nilai_nfi = '0';
                    $r->nilai_hni = '0';    
                }else{
                    if( $r->nilai == '0' ){
                        $r->nilai_nfi = '0';
                        $r->nilai_hni = '0';
                    }
                    else{
                        $r->nilai_nfi = $nilai[0]->nilai / $r->nilai * 100;
                        $r->nilai_hni = $nilai[1]->nilai / $r->nilai * 100;
                    }
                }
            }else{
                $r->nilai_nfi = '0';
                $r->nilai_hni = '0';    
            }
        }
        $bagian = bagian::join('workcenter','bagian.workcenter_id', 'workcenter.id')
                            ->join('kategori', 'workcenter.kategori_id', 'kategori.id')
                            ->select("bagian.*", "workcenter.workcenter", "kategori.kategori")
                            ->where('kategori.id', $id)->get();
                            
        return [$report, $bagian];
        
    }
    public function detailReport($id, $tgl){
        return view('utilityOnline.admin.detailReport', ['menus' => $this->menu, 'username' => $this->username]);
    } 
    public function report3Tgl($from, $to)
    {
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  
        $no = 0;
        foreach ($cek as $c ) {
            $no++;
        }
        $bagian = [];
        for ($i=0; $i < $no; $i++) { 
            $tgl = $cek[$i];
            $a = $this->rasioBagian(['70','71'], '', $tgl);
            
            if($a == 0){
                $lbwp = 0;
                $wbp = 0;
            }else{
                $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
            }
            $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
            $ups1 = $this->rasioBagian(['37'], '', $tgl);
            $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
            $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
            $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
            $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
            $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
            $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
            $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
            $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
            $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
            $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
            $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
            $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
            $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
            $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
            $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
            $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
            $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
            $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
            $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);


            $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
            $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
            //  ================================= Water ====================================

            $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
             
            $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
            $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
            $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
            $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
            $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
            $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
            $permeateRo = $this->rasioBagian(['84'], '', $tgl);
            $rejectWater = $this->rasioBagian(['85'], '', $tgl);
            $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
            $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
            $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
            if($waterRecycleRate == '0'){
                $waterRecycleRate = 0;
            }else{
                $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                if($cekcek == 0){
                    $waterRecycleRate = 0;
                }else{
                    $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                }
            }
            
            // NFI
            $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
            $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
            $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
            $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
            // HNI
            $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
            $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
            $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
            $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
            $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
            $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
    
            // Demin Water Boiler
            //  Boiler - Ruby
            // Boiler - Greek
            // Boiler - Retort
    
            $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
            $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
            $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
            $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
            
            // ================================= Gas =========================
            $nm3 = $this->rasioBagian(['108'], '', $tgl);        
            $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
            $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
            $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
            $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
            $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
            $nfiProduksi = $nm3 - $gasBoiler10Ton;
            $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
            $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
            $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
            $hniRubySteam = $plantHeader - $hniRuby;
            $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
            
            if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                $hniGreekGas = 0;            
                $hniRetortGas = 0;
                $hniProduksiSolar = 0;
            }else{
                $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
            array_push($bagian, ['bagian' => 'PLN', 'nilai' => $a * 3.2, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'LWBP', 'nilai' => $lbwp, 'satuan' => '%', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'WBP', 'nilai' => $wbp,  'satuan' => '%', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'UPS Charging', 'nilai' => $ups, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'NFI TOTAl', 'nilai' => $nfiTotal, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'FRC', 'nilai' => $frc, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'UPS FRC', 'nilai' => ($frc/$fr)* $ups, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'LAB', 'nilai' => $lab, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // Start
            array_push($bagian, ['bagian' => 'WTP & WWTP', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // End
            array_push($bagian, ['bagian' => 'LPGP', 'nilai' => $lpgp, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'AC', 'nilai' => $ac1 - $ac2, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian,  ['bagian' => 'RC', 'nilai' => $rc1, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HYDRANT', 'nilai' => $hydrant, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            // start
            array_push($bagian, ['bagian' => 'DEEPWELL', 'nilai' => " ", 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'UTILITY TOTAL', 'nilai' => " ", 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Boiler', 'nilai' => " ", 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            // End
            array_push($bagian,  ['bagian' => 'Chiller', 'nilai' => $chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Compressor', 'nilai' => $compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor), 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Cooling Tower', 'nilai' => $coolingTower, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            // start
            array_push($bagian, ['bagian' => 'HNI TOTAL', 'nilai' => $coolingTower, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'PRODUKSI', 'nilai' => $coolingTower, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
            // End
            array_push($bagian, ['bagian' => 'RUBY', 'nilai' => $ruby, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'UPS RUBY', 'nilai' => ($ruby / $fr) * $ups, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'GREEK', 'nilai' => $greek, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'BAKERY', 'nilai' => $bakery, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'OFFICE-RD', 'nilai' => $officeRd, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'AC GUDANG', 'nilai' => $acGudang, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // Start
            array_push($bagian, ['bagian' => 'WTP & WWTP', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'RUBY', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'GREEK', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Non-Produksi', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // End
            array_push($bagian, ['bagian' => 'RC', 'nilai' => $rc, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // Start
            array_push($bagian, ['bagian' => 'DEEPWELL', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'UTILITY', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'RUBY Utility', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Boiler', 'nilai' => " ", 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // End
            array_push($bagian, ['bagian' => 'Chiller', 'nilai' => ($ruby/$rgf) * $chiller, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Compressor', 'nilai' => ($ruby/$rgf) * $compressor, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Colling Tower', 'nilai' => ($ruby/$rgf) * $coolingTower, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // Start
            array_push($bagian, ['bagian' => 'GREEK  Utility', 'nilai' => ($ruby/$rgf) * $coolingTower, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Boiler', 'nilai' => ($ruby/$rgf) * $coolingTower, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            // End
            array_push($bagian, ['bagian' => 'Chiller', 'nilai' => ($greek/$rgf) * $chiller, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Compressor', 'nilai' => ($greek/$rgf) * $compressor, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Colling Tower', 'nilai' => ($greek/$rgf) * ($greek/$rgf) * $coolingTower, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 

            // ================== Water ===============

            array_push($bagian, ['bagian' => 'ESDM', 'nilai' => $esdm, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Input Rain water WTP IE', 'nilai' => $inputRainWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Input Raw water WTP IE', 'nilai' => $inputRawWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Input process Demin', 'nilai' => $inputProcessDemin, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Input process Soft', 'nilai' => $inputProcessSoft, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Input Embung', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Input Process Recycle', 'nilai' => $inputProcessRecycle, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Permeate RO ', 'nilai' => $permeateRo, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Reject Water', 'nilai' => $rejectWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Waste WTP IE', 'nilai' => $wasteWtpIe, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Waste WTP Recycle', 'nilai' => $wasteWtpRecycle, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Waste Recycle Rate', 'nilai' => $waterRecycleRate, 'satuan' => '%', 'tanggal_penggunaan' => $tgl]); 
            
            array_push($bagian, ['bagian' => 'NFI (Water)', 'nilai' => $inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Demin Water Produksi', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Non Produksi', 'nilai' => $softWaterNonProduksi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Lubrikasi', 'nilai' => $softWaterLubrikasi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Cooling Tower', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Service Water', 'nilai' => $serviceWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 

            
            array_push($bagian, ['bagian' => 'HNI', 'nilai' => $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Demin Water Produksi', 'nilai' => $deminWaterProdukHb, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Demin Water Ruby', 'nilai' => $deminWaterRuby, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Demin Water Greek', 'nilai' => $deminWaterGreek, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksiHb, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Ruby', 'nilai' => $softWaterRuby, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Greek', 'nilai' => $softWaterGreek, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 

            // Error: Dibebankan
            array_push($bagian, ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Boiler - Ruby', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Boiler - Greek', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Boiler - Retort', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 

            array_push($bagian, ['bagian' => 'Soft Water Gedung Depan', 'nilai' => $softWaterGedungDepan, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water HB', 'nilai' => $softWaterHb, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'Soft Water Bakery', 'nilai' => $softWaterBakery, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            // otw
            array_push($bagian, ['bagian' => 'PGN MRS', 'nilai' => "Belum", 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'nm3', 'nilai' => $nm3, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'MMBTU', 'nilai' => $mmbtu, 'satuan' => 'MMBTU', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'PLANT SOLAR', 'nilai' => $plantSolar, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'GAS BOILER 10 TON', 'nilai' => $gasBoiler10Ton, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'GAS BOILER 5 TON', 'nilai' => $gasBoiler5Ton, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'NFI (GAS)', 'nilai' => "Belum", 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'NFI PRODUKSI (STEAM)', 'nilai' => $nfiProduksi, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'NFI PRODUKSI (GAS)', 'nilai' => "Belum", 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'NFI PRODUKSI (SOLAR)', 'nilai' => "Belum", 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI (GAS)', 'nilai' => "Belum", 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI RUBY (STEAM)', 'nilai' => $hniRubySteam, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI GREEK (STEAM)', 'nilai' => $hniGreekGas, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI RETORT (STEAM)', 'nilai' => $hniRetortGas, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI RUBY (GAS)', 'nilai' => $hniRuby, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI GREEK (GAS)', 'nilai' => $hniGreekGas, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI RETORT (GAS)', 'nilai' => $hniRetortGas, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            array_push($bagian, ['bagian' => 'HNI PRODUKSI (SOLAR)', 'nilai' => $hniProduksiSolar, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
        }
        
        return $bagian;   
        
    }
    public function report3Kategori($kategori, $from ="", $to=""){
        if($from == "" && $to == ""){
            $from = penggunaan::orderBy('tgl_penggunaan', 'asc')->first();
            if($from){
                $from = $from->tgl_penggunaan;
            }else{
                $from = "2019-02-30";
            }
            $to = penggunaan::orderBy('tgl_penggunaan', 'desc')->first();
            if($to){
                $to = $to->tgl_penggunaan;
            }else{
                $to = "2019-02-30";
            }
            
            $tz = 'Asia/Jakarta';
            $from1 = explode('-', $from);
            $to1 = explode('-', $to);        
            $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);     
            $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
            $cek = $this->generateDateRange($from1, $to1);  
            $no = 0;
            foreach ($cek as $c ) {
                $no++;
            }
        }else{
            $tz = 'Asia/Jakarta';
            $from1 = explode('-', $from);
            $to1 = explode('-', $to);        
            $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
            $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
            $cek = $this->generateDateRange($from1, $to1);  
            $no = 0;
            foreach ($cek as $c ) {
                $no++;
            }
        }
        if ($kategori == '1') {
            $bagian = [];
            for ($i=0; $i < $no; $i++) { 
                $tgl = $cek[$i];
                $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                 
                $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                if($waterRecycleRate == '0'){
                    $waterRecycleRate = 0;
                }else{
                    $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($cekcek == 0){
                        $waterRecycleRate = 0;
                    }else{
                        $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                    }
                }
                
                // NFI
                $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);        
                $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);
                $deminWaterProduksiNfi = $this->rasioBagian(['118'], 'NFI', $tgl);
                // HNI
                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
        
                // Demin Water Boiler
                //  Boiler - Ruby
                // Boiler - Greek
                // Boiler - Retort
        
                $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                
                array_push($bagian, ['bagian' => 'ESDM', 'nilai' => $esdm, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Input Rain water WTP IE', 'nilai' => $inputRainWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Input Raw water WTP IE', 'nilai' => $inputRawWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Input process Demin', 'nilai' => $inputProcessDemin, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Input process Soft', 'nilai' => $inputProcessSoft, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Input Embung', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Input Process Recycle', 'nilai' => $inputProcessRecycle, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Permeate RO ', 'nilai' => $permeateRo, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Reject Water', 'nilai' => $rejectWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Waste WTP IE', 'nilai' => $wasteWtpIe, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Waste WTP Recycle', 'nilai' => $wasteWtpRecycle, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Waste Recycle Rate', 'nilai' => "Rumusnya dimerahin", 'satuan' => '%', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'NFI (Water)', 'nilai' => $inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Demin Water Produksi', 'nilai' => $deminWaterProduksiNfi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Non Produksi', 'nilai' => $softWaterNonProduksi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Lubrikasi', 'nilai' => $softWaterLubrikasi, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Cooling Tower', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Service Water', 'nilai' => $serviceWater, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI', 'nilai' => $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Demin Water Produksi', 'nilai' => $deminWaterProdukHb, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Demin Water Ruby', 'nilai' => $deminWaterRuby, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Demin Water Greek', 'nilai' => $deminWaterGreek, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksiHb, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Ruby', 'nilai' => $softWaterRuby, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Greek', 'nilai' => $softWaterGreek, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                
                array_push($bagian, ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Boiler - Ruby', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Boiler - Greek', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Boiler - Retort', 'nilai' => $inputEmbung, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                
                array_push($bagian, ['bagian' => 'Soft Water Gedung Depan', 'nilai' => $softWaterGedungDepan, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water HB', 'nilai' => $softWaterHb, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Soft Water Bakery', 'nilai' => $softWaterBakery, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
            }
            
            return $bagian;   
            
        }
        else if($kategori == '2'){

            $bagian = [];
            for ($i=0; $i < $no; $i++) { 
                $tgl = $cek[$i];
                $a = $this->rasioBagian(['70','71'], '', $tgl);
                
                if($a == 0){
                    $lbwp = 0;
                    $wbp = 0;
                }else{
                    $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                    $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                }
                $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
                $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
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
                array_push($bagian, ['bagian' => 'PLN', 'nilai' => $a * 3.2, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'LWBP', 'nilai' => $lbwp, 'satuan' => '%', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'WBP', 'nilai' => $wbp,  'satuan' => '%', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'UPS Charging', 'nilai' => $ups, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'NFI TOTAl', 'nilai' => $nfiTotal, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'FRC', 'nilai' => $frc, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'UPS FRC', 'nilai' => ($frc/$fr)* $ups, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'LAB', 'nilai' => $lab, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                // 'WTP & WWTP'
                array_push($bagian, ['bagian' => 'LPGP', 'nilai' => $lpgp, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'AC', 'nilai' => $ac1 - $ac2, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian,  ['bagian' => 'RC', 'nilai' => $rc1, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HYDRANT', 'nilai' => $hydrant, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
                // 'DEEPWELL' => penggunaan::where
                // 'UTILITY TOTAL'
                // 'Boiler'
                array_push($bagian,  ['bagian' => 'Chiller', 'nilai' => $chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Compressor', 'nilai' => $compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor), 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Cooling Tower', 'nilai' => $coolingTower, 'satuan' => '', 'tanggal_penggunaan' => $tgl]); 
                // 'HNI TOTAL'
                // 'PRODUKSI'
                array_push($bagian, ['bagian' => 'RUBY', 'nilai' => $ruby, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'UPS RUBY', 'nilai' => ($ruby / $fr) * $ups, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'GREEK', 'nilai' => $greek, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'BAKERY', 'nilai' => $bakery, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'OFFICE-RD', 'nilai' => $officeRd, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'AC GUDANG', 'nilai' => $acGudang, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                // 'WTP & WWTP'
                // 'RUBY'
                // 'GREEK'
                // 'Non-Produksi'
                array_push($bagian, ['bagian' => 'RC', 'nilai' => $rc, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                // 'DEEPWELL'
                // 'UTILITY'
                // 'RUBY Utility'
                // 'Boiler' => ($ruby/$rgf) * $chiller,
                array_push($bagian, ['bagian' => 'Chiller', 'nilai' => ($ruby/$rgf) * $chiller, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Compressor', 'nilai' => ($ruby/$rgf) * $compressor, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Colling Tower', 'nilai' => ($ruby/$rgf) * $coolingTower, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                // 'GREEK  Utility'
                // 'Boiler'
    
                array_push($bagian, ['bagian' => 'Chiller', 'nilai' => ($greek/$rgf) * $chiller, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Compressor', 'nilai' => ($greek/$rgf) * $compressor, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'Colling Tower', 'nilai' => ($greek/$rgf) * ($greek/$rgf) * $coolingTower, 'satuan' => 'Mwh', 'tanggal_penggunaan' => $tgl]); 
            }
            return $bagian;   
            
        }
        else if($kategori == '3'){
            $bagian = [];
            for ($i=0; $i < $no; $i++) { 
                $tgl = $cek[$i];
                
                // ================================= Gas =========================
                $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                $nfiProduksi = $nm3 - $gasBoiler10Ton;
                $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                $hniRubySteam = $plantHeader - $hniRuby;
                $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                
                if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                    $hniGreekGas = 0;            
                    $hniRetortGas = 0;
                    $hniProduksiSolar = 0;
                }else{
                    $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                    $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                    $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
                }
                
                array_push($bagian, ['bagian' => 'PGN MRS', 'nilai' => "Belum", 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'nm3', 'nilai' => $nm3, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'MMBTU', 'nilai' => $mmbtu, 'satuan' => 'MMBTU', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'PLANT SOLAR', 'nilai' => $plantSolar, 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'GAS BOILER 10 TON', 'nilai' => $gasBoiler10Ton, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'GAS BOILER 5 TON', 'nilai' => $gasBoiler5Ton, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'NFI (GAS)', 'nilai' => "Belum", 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'NFI PRODUKSI (STEAM)', 'nilai' => $nfiProduksi, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'NFI PRODUKSI (GAS)', 'nilai' => "Belum", 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'NFI PRODUKSI (SOLAR)', 'nilai' => "Belum", 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI (GAS)', 'nilai' => "Belum", 'satuan' => 'm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI RUBY (STEAM)', 'nilai' => $hniRubySteam, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI GREEK (STEAM)', 'nilai' => $hniGreekGas, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI RETORT (STEAM)', 'nilai' => $hniRetortGas, 'satuan' => 'kg', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI RUBY (GAS)', 'nilai' => $hniRuby, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI GREEK (GAS)', 'nilai' => $hniGreekGas, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI RETORT (GAS)', 'nilai' => $hniRetortGas, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian, ['bagian' => 'HNI PRODUKSI (SOLAR)', 'nilai' => $hniProduksiSolar, 'satuan' => 'nm3', 'tanggal_penggunaan' => $tgl]); 
            }
            return $bagian;   
            
        }
         
    }
    public function report4Tgl($from, $to){
        $from1 = $from;
        $to1 = $to;
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  
        $bagian = [];
        foreach ($cek as $tgl ) {

            // Rumus
            $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
            $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
            $frc = $frc1 - $frc2;
            $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
            // Wtp dan wwtp
            // Deepwell
            // Utility Total
            $nfiVarLoad = $frc + $lab;

            $ups1 = $this->rasioBagian(['37'], '', $tgl);
            $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
            $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
            $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
            $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
            $ac = $ac1 - $ac2;
            $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
            $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
            $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
            if($frc + $ruby == 0){
                $fr = 1;
            }else{
                $fr = $frc + $ruby;
            }
            $ups = $ups1 - $ups2;
            $upsRuby = ($frc/$fr)* $ups;
            $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;

            $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
            // WTR
            // WTG
            // DW2
            $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
            $hniVarLoad = $greek + $ruby + $bakery;

            $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
            $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
            $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
            $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
            $rc = $rc + ($rc1 * 3 / 4);
            // WTO
            $ups1 = $this->rasioBagian(['37'], '', $tgl);
            $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
            $ups = $ups1 - $ups2;
            $upsRuby = ($ruby / $fr) * $ups;
            $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;

            // Demin Water Produksi
            $dsw2 = $this->rasioBagian(['93'], '', $tgl);
            $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
            $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
            $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
            // softwater cooling tower
            $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
            
            $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);

            $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
            $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
            $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
            $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
            $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
            $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
            $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;

            $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
            $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
            // Demin Water Boiler
            $rubyWater = $deminWaterRuby + $softWaterRuby;

            $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
            $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
            // Boiler Greek
            $greekWater = $deminWaterGreek + $softWaterGreek;

            $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
            $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
            $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
            
            // Air
                array_push($bagian, ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $nfiVarLoadWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => $nfiFixLoadWater, 'tgl_penggunaan' => $tgl]);
                
                if($nfiVarLoadWater + $nfiFixLoadWater == '0'){
                    array_push($bagian, ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => '0' , 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => '0' , 'tgl_penggunaan' => $tgl]);
                }else{
                    array_push($bagian, ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => $nfiVarLoadWater / ($nfiVarLoadWater + $nfiFixLoadWater) * 100, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => $nfiFixLoadWater / ($nfiVarLoadWater + $nfiFixLoadWater) * 100, 'tgl_penggunaan' => $tgl]);
                }

                array_push($bagian, ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                if($hniVarloadWater + $softWaterHb == 0){
                    array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                }else{
                    array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => $hniVarloadWater / ($hniVarloadWater + $softWaterHb) * 100, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => $softWaterHb / ($hniVarloadWater + $softWaterHb) * 100, 'tgl_penggunaan' => $tgl]);
                }
            // End Air
            // Listrik
                array_push($bagian, ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                if($nfiVarLoad + $nfiFixLoad == 0){
                    array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => '% Fix Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                }else{
                    array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => '% Fix Load', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                }
                array_push($bagian, ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Bakery', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
                if($nfiVarLoad + $nfiFixLoad == 0){
                    array_push($bagian, ['bagian' => 'HNI % Variable Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                }else{
                    array_push($bagian, ['bagian' => 'HNI % Variable Load', 'satuan' => 'Mwh', 'nilai' => $hniVarLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => $nfiFixLoad / ($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                }
            // End Listrik
        }
        return $bagian;
    }
    public function report4Kategori($id){
        $from = penggunaan::orderBy('tgl_penggunaan', 'asc')->first();
        if($from){
            $from = $from->tgl_penggunaan;
        }else{
            $from = "2019-02-30";
        }
        $to = penggunaan::orderBy('tgl_penggunaan', 'desc')->first();
        if($to){
            $to = $to->tgl_penggunaan;
        }else{
            $to = "2019-02-30";
        }
        
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  
        $no = count($cek);

        $bagian = [];
        if($id == '1'){
            foreach ($cek as $tgl ) {

                // Demin Water Produksi
                $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                // softwater cooling tower
                $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                
                $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);

                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;

                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                // Demin Water Boiler
                $rubyWater = $deminWaterRuby + $softWaterRuby;

                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                // Boiler Greek
                $greekWater = $deminWaterGreek + $softWaterGreek;

                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                if ($hniVarloadWater + $softWaterHb == 0) {
                    $hniVarloadWater = 1;
                }
                
                // Air
                    array_push($bagian, ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $nfiVarLoadWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => $nfiFixLoadWater, 'tgl_penggunaan' => $tgl]);
                    
                    if($nfiVarLoadWater + $nfiFixLoadWater == '0'){
                        array_push($bagian, ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => '0' , 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => '0' , 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => $nfiVarLoadWater / ($nfiVarLoadWater + $nfiFixLoadWater) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => $nfiFixLoadWater / ($nfiVarLoadWater + $nfiFixLoadWater) * 100, 'tgl_penggunaan' => $tgl]);
                    }

                    array_push($bagian, ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                    if($hniVarloadWater + $softWaterHb == 0){
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => $hniVarloadWater / ($hniVarloadWater + $softWaterHb) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => $softWaterHb / ($hniVarloadWater + $softWaterHb) * 100, 'tgl_penggunaan' => $tgl]);
                    }
                // End Air
                
            }
        }
        else if($id == '2'){
            foreach ($cek as $tgl ) {
                // Rumus
                // Rumus
                $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                $frc = $frc1 - $frc2;
                $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                // Wtp dan wwtp
                // Deepwell
                // Utility Total
                $nfiVarLoad = $frc + $lab;

                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                $ac = $ac1 - $ac2;
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                if($frc + $ruby == 0){
                    $fr = 1;
                }else{
                    $fr = $frc + $ruby;
                }
                $ups = $ups1 - $ups2;
                $upsRuby = ($frc/$fr)* $ups;
                $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;

                $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                // WTR
                // WTG
                // DW2
                $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                $hniVarLoad = $greek + $ruby + $bakery;

                $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                $rc = $rc + ($rc1 * 3 / 4);
                // WTO
                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $ups = $ups1 - $ups2;
                $upsRuby = ($ruby / $fr) * $ups;
                $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
                
                if($nfiVarLoad + $nfiFixLoad == 0){
                    $nfiVarLoad = 1;
                }

                // Listrik
                    array_push($bagian, ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                    if($nfiVarLoad + $nfiFixLoad == 0){
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Fix Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Fix Load', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                    }
                    array_push($bagian, ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Bakery', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
                    if($nfiVarLoad + $nfiFixLoad == 0){
                        array_push($bagian, ['bagian' => 'HNI % Variable Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => 'HNI % Variable Load', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => $nfiFixLoad / ($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                    }
                // End Listrik> $tgl]);
            }
        }
        else if($id == '3'){
            foreach ($cek as $tgl ) {
                
            }
        }
        
        return $bagian;
        
    }
    public function report4TglKategori($id, $from, $to){
        $from1 = $from;
        $to1 = $to;
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  

        $bagian = [];
        if($id == '1'){
            foreach ($cek as $tgl ) {

                // Demin Water Produksi
                $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                // softwater cooling tower
                $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                
                $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);

                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;

                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                // Demin Water Boiler
                $rubyWater = $deminWaterRuby + $softWaterRuby;

                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                // Boiler Greek
                $greekWater = $deminWaterGreek + $softWaterGreek;

                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);

                // Air
                    array_push($bagian, ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $nfiVarLoadWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => $nfiFixLoadWater, 'tgl_penggunaan' => $tgl]);
                    
                    if($nfiVarLoadWater + $nfiFixLoadWater == '0'){
                        array_push($bagian, ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => '0' , 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => '0' , 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => $nfiVarLoadWater / ($nfiVarLoadWater + $nfiFixLoadWater) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => $nfiFixLoadWater / ($nfiVarLoadWater + $nfiFixLoadWater) * 100, 'tgl_penggunaan' => $tgl]);
                    }

                    array_push($bagian, ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                    if($hniVarloadWater + $softWaterHb == 0){
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => $hniVarloadWater / ($hniVarloadWater + $softWaterHb) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => '%', 'nilai' => $softWaterHb / ($hniVarloadWater + $softWaterHb) * 100, 'tgl_penggunaan' => $tgl]);
                    }
                // End Air
                
            }
        }
        else if($id == '2'){
            foreach ($cek as $tgl ) {
                // Rumus
                // Rumus
                $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                $frc = $frc1 - $frc2;
                $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                // Wtp dan wwtp
                // Deepwell
                // Utility Total
                $nfiVarLoad = $frc + $lab;

                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                $ac = $ac1 - $ac2;
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                if($frc + $ruby == 0){
                    $fr = 1;
                }else{
                    $fr = $frc + $ruby;
                }
                $ups = $ups1 - $ups2;
                $upsRuby = ($frc/$fr)* $ups;
                $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;

                $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                // WTR
                // WTG
                // DW2
                $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                $hniVarLoad = $greek + $ruby + $bakery;

                $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                $rc = $rc + ($rc1 * 3 / 4);
                // WTO
                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $ups = $ups1 - $ups2;
                $upsRuby = ($ruby / $fr) * $ups;
                $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
                // Listrik
                    array_push($bagian, ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                    if($nfiVarLoad + $nfiFixLoad == 0){
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Fix Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => '% Variable Load', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => '% Fix Load', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                    }
                    array_push($bagian, ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Bakery', 'satuan' => 'Mwh', 'nilai' => 'Belum', 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
                    if($nfiVarLoad + $nfiFixLoad == 0){
                        array_push($bagian, ['bagian' => 'HNI % Variable Load', 'satuan' => 'Mwh', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => "0", 'tgl_penggunaan' => $tgl]);
                    }else{
                        array_push($bagian, ['bagian' => 'HNI % Variable Load', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad /($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian, ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => $nfiFixLoad / ($nfiVarLoad + $nfiFixLoad) * 100, 'tgl_penggunaan' => $tgl]);
                    }
                // End Listrik> $tgl]);
            }
        }
        else if($id == '3'){
            foreach ($cek as $tgl ) {
                
            }
        }
        
        return $bagian;
    }
    public function report2Tgl($from, $to){
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);
        $bagian = bagian::all();
        $no =0;
        foreach ($cek as $c ) {
            $no++;
        }
        foreach ($bagian as $b) 
        {  
            $i = 0;
            $pengamatan = [];
            foreach ($cek as $c ) {
                $i++;
                if($i == $no){
                    $time = explode('-', $c);
                    $dates = Carbon::createFromDate($time[0], $time[1], $time[2], $tz)->addDay('1');
                    $dates = explode(' ', $dates);
                    $date1 = $dates[0];
                    $pengamatanBagian = pengamatan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $date1 . ' 05:59:59'])->first();
                }else{
                    $pengamatanBagian = pengamatan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $cek[$i] . ' 05:59:59'])->first();
                }
                $output = [$pengamatanBagian, $c];
                array_push($pengamatan, $output);
            }
            $b->pengamatan = $pengamatan;
            $b->satuan_id = $b->satuan->satuan;
        }
        return $bagian;
    }
    public function reportBagianTgl($idBagian, $from, $to){
        
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);
        $bagian = bagian::where('workcenter_id', $idBagian)->get();
        $no =0;
        foreach ($cek as $c ) {
            $no++;
        }
        foreach ($bagian as $b) 
        {  
            $i = 0;
            $pengamatan = [];
            foreach ($cek as $c ) {
                $i++;
                if($i == $no){
                    $time = explode('-', $c);
                    $dates = Carbon::createFromDate($time[0], $time[1], $time[2], $tz)->addDay('1');
                    $dates = explode(' ', $dates);
                    $date1 = $dates[0];
                    $pengamatanBagian = pengamatan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $date1 . ' 05:59:59'])->first();
                }else{
                    $pengamatanBagian = pengamatan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $cek[$i] . ' 05:59:59'])->first();
                }
                $output = [$pengamatanBagian, $c];
                array_push($pengamatan, $output);
            }
            $b->pengamatan = $pengamatan;
            $b->satuan_id = $b->satuan->satuan;
        }
        return $bagian;
    }
    public function report5Tgl($from, $to){
        $from1 = $from;
        $to1 = $to;
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  
        $bagian = [];
        foreach ($cek as $tgl ) {

            // Report 3
                $a = $this->rasioBagian(['70','71'], '', $tgl);
                
                if($a == 0){
                    $lbwp = 0;
                    $wbp = 0;
                }else{
                    $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                    $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                }
                $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);


                $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                //  ================================= Water ====================================

                $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                
                $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                if($waterRecycleRate == '0'){
                    $waterRecycleRate = 0;
                }else{
                    $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($cekcek == 0){
                        $waterRecycleRate = 0;
                    }else{
                        $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                    }
                }
                
                // NFI
                $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                // HNI
                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
        
                // Demin Water Boiler
                //  Boiler - Ruby
                // Boiler - Greek
                // Boiler - Retort
        
                $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                
                // ================================= Gas =========================
                $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                $nfiProduksi = $nm3 - $gasBoiler10Ton;
                $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                $hniRubySteam = $plantHeader - $hniRuby;
                $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                
                if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                    $hniGreekGas = 0;            
                    $hniRetortGas = 0;
                    $hniProduksiSolar = 0;
                }else{
                    $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                    $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                    $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
            // End report 3
            
            // Report 4
                $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                $frc = $frc1 - $frc2;
                $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                // Wtp dan wwtp
                // Deepwell
                // Utility Total
                $nfiVarLoad = $frc + $lab;

                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                $ac = $ac1 - $ac2;
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                if($frc + $ruby == 0){
                    $fr = 1;
                }else{
                    $fr = $frc + $ruby;
                }
                $ups = $ups1 - $ups2;
                $upsRuby = ($frc/$fr)* $ups;
                $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;

                $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                // WTR
                // WTG
                // DW2
                $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                $hniVarLoad = $greek + $ruby + $bakery;

                $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                $rc = $rc + ($rc1 * 3 / 4);
                // WTO
                $ups1 = $this->rasioBagian(['37'], '', $tgl);
                $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                $ups = $ups1 - $ups2;
                $upsRuby = ($ruby / $fr) * $ups;
                $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;

                // Demin Water Produksi
                $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                // softwater cooling tower
                $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                
                $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);

                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;

                $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                // Demin Water Boiler
                $rubyWater = $deminWaterRuby + $softWaterRuby;

                $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                // Boiler Greek
                $greekWater = $deminWaterGreek + $softWaterGreek;

                $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
            // End Report 4

            $penggunaanGasNfi = $nfiProduksi; //Belum ditambah

            // NFI
            $nfi = $softWaterProduksi + $softWaterNonProduksi +$softWaterLubrikasi + $serviceWater;
            // HNI
            $hni = $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterRuby + $softWaterGreek + $softWaterProduksiHb;

            // Water
            array_push($bagian, ['bagian' => 'Production Usage per HK - NFI', 'satuan' => 'm3/day', 'nilai' => $hni + $nfi, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK', 'satuan' => 'm3/day', 'nilai' => $nfiFixLoad + $greekWater / 100 , 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY', 'satuan' => 'm3/day', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - NFI', 'satuan' => 'm3/day', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - HNI', 'satuan' => 'm3/day', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => '% Usage NFI', 'satuan' => '%', 'nilai' => ($inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater) * 100 , 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => '% Usage HNI', 'satuan' => '%', 'nilai' => ($deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery) * 100, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Tonase NFI', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Tonase HNI', 'satuan' => 'm3/ton', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3/ton', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3/ton', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
            
            // Listrik
            // Dibagi hari kerja
            array_push($bagian, ['bagian' => 'Production Usage per HK - NFI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK (Listrik)', 'satuan' => 'm3/day', 'nilai' => 'Belumm', 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY (Listrik)', 'satuan' => 'm3/day', 'nilai' => "BELUm", 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - NFI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - HNI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => '% Usage NFI (Listrik)', 'satuan' => '%', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => '% Usage HNI (Listrik)', 'satuan' => '%', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                // DIbagi tonase    
                array_push($bagian, ['bagian' => 'Tonase NFI (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase HNI (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);

            array_push($bagian, ['bagian' => 'Greek (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Ruby (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);

            // Gas
            // Dibagi Hari Kerja
                array_push($bagian, ['bagian' => 'Production Usage per HK - NFI', 'satuan' => 'm3/day', 'nilai' => $hni + $nfi, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK', 'satuan' => 'm3/day', 'nilai' => $nfiFixLoadWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY', 'satuan' => 'm3/day', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RETORT', 'satuan' => 'm3/day', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => '% Usage NFI', 'satuan' => '%', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => '% Usage HNI', 'satuan' => '%', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Tonase NFI', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Tonase HNI', 'satuan' => 'm3/ton', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3/ton', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
            array_push($bagian, ['bagian' => 'RETORT', 'satuan' => 'm3/ton', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
        }
        return $bagian;
    }
    public function report5TglKategori($id,$from, $to){
        $from1 = $from;
        $to1 = $to;
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);
        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  

        $bagian = [];
        if($id == '1'){
            foreach ($cek as $tgl ) {

                // Report 3
                    $a = $this->rasioBagian(['70','71'], '', $tgl);
                    
                    if($a == 0){
                        $lbwp = 0;
                        $wbp = 0;
                    }else{
                        $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                        $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                    }
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                    $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                    $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
    
    
                    $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                    $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                    //  ================================= Water ====================================
    
                    $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                    
                    $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                    $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                    $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                    $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                    $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                    $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                    $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                    $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                    $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                    $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                    $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($waterRecycleRate == '0'){
                        $waterRecycleRate = 0;
                    }else{
                        $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                        if($cekcek == 0){
                            $waterRecycleRate = 0;
                        }else{
                            $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                        }
                    }
                    
                    // NFI
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                    $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                    // HNI
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            
                    // Demin Water Boiler
                    //  Boiler - Ruby
                    // Boiler - Greek
                    // Boiler - Retort
            
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    
                    // ================================= Gas =========================
                    $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                    $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                    $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                    $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                    $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                    $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                    $nfiProduksi = $nm3 - $gasBoiler10Ton;
                    $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                    $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                    $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                    $hniRubySteam = $plantHeader - $hniRuby;
                    $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                    
                    if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                        $hniGreekGas = 0;            
                        $hniRetortGas = 0;
                        $hniProduksiSolar = 0;
                    }else{
                        $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
                // End report 3
                
                // Report 4
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $frc = $frc1 - $frc2;
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    // Wtp dan wwtp
                    // Deepwell
                    // Utility Total
                    $nfiVarLoad = $frc + $lab;
    
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $ac = $ac1 - $ac2;
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    if($frc + $ruby == 0){
                        $fr = 1;
                    }else{
                        $fr = $frc + $ruby;
                    }
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($frc/$fr)* $ups;
                    $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;
    
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    // WTR
                    // WTG
                    // DW2
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $hniVarLoad = $greek + $ruby + $bakery;
    
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $rc + ($rc1 * 3 / 4);
                    // WTO
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($ruby / $fr) * $ups;
                    $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
    
                    // Demin Water Produksi
                    $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                    // softwater cooling tower
                    $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                    
                    $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                    // Demin Water Boiler
                    $rubyWater = $deminWaterRuby + $softWaterRuby;
    
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    // Boiler Greek
                    $greekWater = $deminWaterGreek + $softWaterGreek;
    
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                // End Report 4
    
                $penggunaanGasNfi = $nfiProduksi; //Belum ditambah
    
                // NFI
                $nfi = $softWaterProduksi + $softWaterNonProduksi +$softWaterLubrikasi + $serviceWater;
                // HNI
                $hni = $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterRuby + $softWaterGreek + $softWaterProduksiHb;
                

                // Water
                    array_push($bagian, ['bagian' => 'Production Usage per HK - NFI', 'satuan' => 'm3/day', 'nilai' => $hni + $nfi, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK', 'satuan' => 'm3/day', 'nilai' => $nfiFixLoad + $greekWater / 100 , 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY', 'satuan' => 'm3/day', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - NFI', 'satuan' => 'm3/day', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - HNI', 'satuan' => 'm3/day', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage NFI', 'satuan' => '%', 'nilai' => ($inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater) * 100 , 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage HNI', 'satuan' => '%', 'nilai' => ($deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery) * 100, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase NFI', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase HNI', 'satuan' => 'm3/ton', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3/ton', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3/ton', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
            }
        }
        else if($id == '2'){
            foreach ($cek as $tgl ) {

                // Report 3
                    $a = $this->rasioBagian(['70','71'], '', $tgl);
                    
                    if($a == 0){
                        $lbwp = 0;
                        $wbp = 0;
                    }else{
                        $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                        $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                    }
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                    $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                    $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
    
    
                    $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                    $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                    //  ================================= Water ====================================
    
                    $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                    
                    $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                    $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                    $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                    $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                    $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                    $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                    $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                    $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                    $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                    $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                    $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($waterRecycleRate == '0'){
                        $waterRecycleRate = 0;
                    }else{
                        $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                        if($cekcek == 0){
                            $waterRecycleRate = 0;
                        }else{
                            $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                        }
                    }
                    
                    // NFI
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                    $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                    // HNI
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            
                    // Demin Water Boiler
                    //  Boiler - Ruby
                    // Boiler - Greek
                    // Boiler - Retort
            
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    
                    // ================================= Gas =========================
                    $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                    $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                    $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                    $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                    $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                    $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                    $nfiProduksi = $nm3 - $gasBoiler10Ton;
                    $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                    $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                    $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                    $hniRubySteam = $plantHeader - $hniRuby;
                    $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                    
                    if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                        $hniGreekGas = 0;            
                        $hniRetortGas = 0;
                        $hniProduksiSolar = 0;
                    }else{
                        $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
                // End report 3
                
                // Report 4
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $frc = $frc1 - $frc2;
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    // Wtp dan wwtp
                    // Deepwell
                    // Utility Total
                    $nfiVarLoad = $frc + $lab;
    
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $ac = $ac1 - $ac2;
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    if($frc + $ruby == 0){
                        $fr = 1;
                    }else{
                        $fr = $frc + $ruby;
                    }
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($frc/$fr)* $ups;
                    $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;
    
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    // WTR
                    // WTG
                    // DW2
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $hniVarLoad = $greek + $ruby + $bakery;
    
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $rc + ($rc1 * 3 / 4);
                    // WTO
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($ruby / $fr) * $ups;
                    $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
    
                    // Demin Water Produksi
                    $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                    // softwater cooling tower
                    $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                    
                    $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                    // Demin Water Boiler
                    $rubyWater = $deminWaterRuby + $softWaterRuby;
    
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    // Boiler Greek
                    $greekWater = $deminWaterGreek + $softWaterGreek;
    
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                // End Report 4
    
                $penggunaanGasNfi = $nfiProduksi; //Belum ditambah
    
                // Listrik
                // Dibagi hari kerja
                array_push($bagian, ['bagian' => 'Production Usage per HK - NFI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK (Listrik)', 'satuan' => 'm3/day', 'nilai' => 'Belumm', 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY (Listrik)', 'satuan' => 'm3/day', 'nilai' => "BELUm", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - NFI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - HNI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage NFI (Listrik)', 'satuan' => '%', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage HNI (Listrik)', 'satuan' => '%', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                    // DIbagi tonase    
                    array_push($bagian, ['bagian' => 'Tonase NFI (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Tonase HNI (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);

                array_push($bagian, ['bagian' => 'Greek (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
            }
        }
        else if($id == '3'){
            foreach ($cek as $tgl ) {

                // Report 3
                    $a = $this->rasioBagian(['70','71'], '', $tgl);
                    
                    if($a == 0){
                        $lbwp = 0;
                        $wbp = 0;
                    }else{
                        $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                        $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                    }
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                    $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                    $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
    
    
                    $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                    $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                    //  ================================= Water ====================================
    
                    $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                    
                    $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                    $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                    $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                    $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                    $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                    $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                    $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                    $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                    $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                    $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                    $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($waterRecycleRate == '0'){
                        $waterRecycleRate = 0;
                    }else{
                        $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                        if($cekcek == 0){
                            $waterRecycleRate = 0;
                        }else{
                            $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                        }
                    }
                    
                    // NFI
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                    $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                    // HNI
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            
                    // Demin Water Boiler
                    //  Boiler - Ruby
                    // Boiler - Greek
                    // Boiler - Retort
            
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    
                    // ================================= Gas =========================
                    $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                    $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                    $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                    $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                    $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                    $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                    $nfiProduksi = $nm3 - $gasBoiler10Ton;
                    $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                    $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                    $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                    $hniRubySteam = $plantHeader - $hniRuby;
                    $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                    
                    if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                        $hniGreekGas = 0;            
                        $hniRetortGas = 0;
                        $hniProduksiSolar = 0;
                    }else{
                        $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
                // End report 3
                
                // Report 4
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $frc = $frc1 - $frc2;
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    // Wtp dan wwtp
                    // Deepwell
                    // Utility Total
                    $nfiVarLoad = $frc + $lab;
    
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $ac = $ac1 - $ac2;
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    if($frc + $ruby == 0){
                        $fr = 1;
                    }else{
                        $fr = $frc + $ruby;
                    }
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($frc/$fr)* $ups;
                    $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;
    
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    // WTR
                    // WTG
                    // DW2
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $hniVarLoad = $greek + $ruby + $bakery;
    
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $rc + ($rc1 * 3 / 4);
                    // WTO
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($ruby / $fr) * $ups;
                    $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
    
                    // Demin Water Produksi
                    $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                    // softwater cooling tower
                    $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                    
                    $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                    // Demin Water Boiler
                    $rubyWater = $deminWaterRuby + $softWaterRuby;
    
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    // Boiler Greek
                    $greekWater = $deminWaterGreek + $softWaterGreek;
    
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                // End Report 4
    
                $penggunaanGasNfi = $nfiProduksi; //Belum ditambah
                // NFI
                $nfi = $softWaterProduksi + $softWaterNonProduksi +$softWaterLubrikasi + $serviceWater;
                // HNI
                $hni = $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterRuby + $softWaterGreek + $softWaterProduksiHb;

                // Gas
                    // Dibagi Hari Kerja
                    array_push($bagian, ['bagian' => 'Production Usage per HK - NFI', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RETORT', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage NFI', 'satuan' => '%', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage HNI', 'satuan' => '%', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase NFI', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase HNI', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'RETORT', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
            }
        }
        
        return $bagian;
    }
    public function report5Kategori($id){
        $from = penggunaan::orderBy('tgl_penggunaan', 'asc')->first();
        if($from){
            $from = $from->tgl_penggunaan;
        }else{
            $from = "2019-02-30";
        }
        $to = penggunaan::orderBy('tgl_penggunaan', 'desc')->first();
        if($to){
            $to = $to->tgl_penggunaan;
        }else{
            $to = "2019-02-30";
        }
        
        $tz = 'Asia/Jakarta';
        $from1 = explode('-', $from);
        $to1 = explode('-', $to);        
        $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
        $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
        $cek = $this->generateDateRange($from1, $to1);  
        $no = count($cek);

        $bagian = [];
        if($id == '1'){
            foreach ($cek as $tgl ) {

                // Report 3
                    $a = $this->rasioBagian(['70','71'], '', $tgl);
                    
                    if($a == 0){
                        $lbwp = 0;
                        $wbp = 0;
                    }else{
                        $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                        $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                    }
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                    $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                    $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
    
    
                    $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                    $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                    //  ================================= Water ====================================
    
                    $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                    
                    $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                    $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                    $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                    $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                    $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                    $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                    $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                    $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                    $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                    $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                    $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($waterRecycleRate == '0'){
                        $waterRecycleRate = 0;
                    }else{
                        $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                        if($cekcek == 0){
                            $waterRecycleRate = 0;
                        }else{
                            $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                        }
                    }
                    
                    // NFI
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                    $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                    // HNI
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            
                    // Demin Water Boiler
                    //  Boiler - Ruby
                    // Boiler - Greek
                    // Boiler - Retort
            
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    
                    // ================================= Gas =========================
                    $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                    $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                    $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                    $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                    $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                    $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                    $nfiProduksi = $nm3 - $gasBoiler10Ton;
                    $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                    $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                    $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                    $hniRubySteam = $plantHeader - $hniRuby;
                    $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                    
                    if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                        $hniGreekGas = 0;            
                        $hniRetortGas = 0;
                        $hniProduksiSolar = 0;
                    }else{
                        $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
                // End report 3
                
                // Report 4
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $frc = $frc1 - $frc2;
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    // Wtp dan wwtp
                    // Deepwell
                    // Utility Total
                    $nfiVarLoad = $frc + $lab;
    
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $ac = $ac1 - $ac2;
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    if($frc + $ruby == 0){
                        $fr = 1;
                    }else{
                        $fr = $frc + $ruby;
                    }
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($frc/$fr)* $ups;
                    $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;
    
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    // WTR
                    // WTG
                    // DW2
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $hniVarLoad = $greek + $ruby + $bakery;
    
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $rc + ($rc1 * 3 / 4);
                    // WTO
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($ruby / $fr) * $ups;
                    $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
    
                    // Demin Water Produksi
                    $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                    // softwater cooling tower
                    $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                    
                    $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                    // Demin Water Boiler
                    $rubyWater = $deminWaterRuby + $softWaterRuby;
    
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    // Boiler Greek
                    $greekWater = $deminWaterGreek + $softWaterGreek;
    
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                // End Report 4
    
                $penggunaanGasNfi = $nfiProduksi; //Belum ditambah
    
                // NFI
                $nfi = $softWaterProduksi + $softWaterNonProduksi +$softWaterLubrikasi + $serviceWater;
                // HNI
                $hni = $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterRuby + $softWaterGreek + $softWaterProduksiHb;
                

                // Water
                    array_push($bagian, ['bagian' => 'Production Usage per HK - NFI', 'satuan' => 'm3/day', 'nilai' => $hni + $nfi, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK', 'satuan' => 'm3/day', 'nilai' => $nfiFixLoad + $greekWater / 100 , 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY', 'satuan' => 'm3/day', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - NFI', 'satuan' => 'm3/day', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - HNI', 'satuan' => 'm3/day', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage NFI', 'satuan' => '%', 'nilai' => ($inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater) * 100 , 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage HNI', 'satuan' => '%', 'nilai' => ($deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery) * 100, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase NFI', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase HNI', 'satuan' => 'm3/ton', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3/ton', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3/ton', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
            }
        }
        else if($id == '2'){
            foreach ($cek as $tgl ) {

                // Report 3
                    $a = $this->rasioBagian(['70','71'], '', $tgl);
                    
                    if($a == 0){
                        $lbwp = 0;
                        $wbp = 0;
                    }else{
                        $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                        $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                    }
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                    $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                    $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
    
    
                    $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                    $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                    //  ================================= Water ====================================
    
                    $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                    
                    $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                    $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                    $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                    $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                    $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                    $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                    $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                    $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                    $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                    $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                    $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($waterRecycleRate == '0'){
                        $waterRecycleRate = 0;
                    }else{
                        $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                        if($cekcek == 0){
                            $waterRecycleRate = 0;
                        }else{
                            $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                        }
                    }
                    
                    // NFI
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                    $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                    // HNI
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            
                    // Demin Water Boiler
                    //  Boiler - Ruby
                    // Boiler - Greek
                    // Boiler - Retort
            
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    
                    // ================================= Gas =========================
                    $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                    $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                    $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                    $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                    $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                    $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                    $nfiProduksi = $nm3 - $gasBoiler10Ton;
                    $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                    $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                    $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                    $hniRubySteam = $plantHeader - $hniRuby;
                    $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                    
                    if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                        $hniGreekGas = 0;            
                        $hniRetortGas = 0;
                        $hniProduksiSolar = 0;
                    }else{
                        $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
                // End report 3
                
                // Report 4
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $frc = $frc1 - $frc2;
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    // Wtp dan wwtp
                    // Deepwell
                    // Utility Total
                    $nfiVarLoad = $frc + $lab;
    
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $ac = $ac1 - $ac2;
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    if($frc + $ruby == 0){
                        $fr = 1;
                    }else{
                        $fr = $frc + $ruby;
                    }
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($frc/$fr)* $ups;
                    $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;
    
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    // WTR
                    // WTG
                    // DW2
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $hniVarLoad = $greek + $ruby + $bakery;
    
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $rc + ($rc1 * 3 / 4);
                    // WTO
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($ruby / $fr) * $ups;
                    $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
    
                    // Demin Water Produksi
                    $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                    // softwater cooling tower
                    $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                    
                    $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                    // Demin Water Boiler
                    $rubyWater = $deminWaterRuby + $softWaterRuby;
    
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    // Boiler Greek
                    $greekWater = $deminWaterGreek + $softWaterGreek;
    
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                // End Report 4
    
                $penggunaanGasNfi = $nfiProduksi; //Belum ditambah
    
                // Listrik
                // Dibagi hari kerja
                array_push($bagian, ['bagian' => 'Production Usage per HK - NFI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK (Listrik)', 'satuan' => 'm3/day', 'nilai' => 'Belumm', 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY (Listrik)', 'satuan' => 'm3/day', 'nilai' => "BELUm", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - NFI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Fix Consumption Usage per day - HNI (Listrik)', 'satuan' => 'm3/day', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage NFI (Listrik)', 'satuan' => '%', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage HNI (Listrik)', 'satuan' => '%', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                    // DIbagi tonase    
                    array_push($bagian, ['bagian' => 'Tonase NFI (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Tonase HNI (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);

                array_push($bagian, ['bagian' => 'Greek (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby (Listrik)', 'satuan' => 'm3/ton', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
            }
        }
        else if($id == '3'){
            foreach ($cek as $tgl ) {

                // Report 3
                    $a = $this->rasioBagian(['70','71'], '', $tgl);
                    
                    if($a == 0){
                        $lbwp = 0;
                        $wbp = 0;
                    }else{
                        $lbwp = $this->rasioBagian(['70'], '', $tgl) / $a * 1;
                        $wbp = $this->rasioBagian(['71'], '', $tgl) / $a * 100;    
                    }
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $nfiTotal = $this->rasioBagian(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $tgl);
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $rc1 = $this->rasioBagian(['48'], 'NFI', $tgl);    
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);            
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rcHni = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $boiler = $this->rasioBagian(['51'], 'HNI', $tgl) * 3 / 4;
                    $chiller = $this->rasioBagian(['52', '53'], 'HNI', $tgl);                
                    $compressor = $this->rasioBagian(['54'], 'HNI', $tgl);
    
    
                    $coolingTowers = $this->rasioBagian(['69'], 'NFI', $tgl);
                    $coolingTower =  $coolingTowers - $this->rasioBagian(['51', '52', '53', '54'], 'NFI', $tgl);
                    //  ================================= Water ====================================
    
                    $esdm = $this->rasioBagian(['74', '75', '76', '77'], 'NFI', $tgl);       
                    
                    $inputRainWater = $this->rasioBagian(['78'], '', $tgl);
                    $inputRawWater = $this->rasioBagian(['79'], '', $tgl);
                    $inputProcessDemin = $this->rasioBagian(['80'], '', $tgl);
                    $inputProcessSoft = $this->rasioBagian(['81'], '', $tgl);
                    $inputEmbung = $this->rasioBagian(['82'], '', $tgl);
                    $inputProcessRecycle = $this->rasioBagian(['83'], '', $tgl);
                    $permeateRo = $this->rasioBagian(['84'], '', $tgl);
                    $rejectWater = $this->rasioBagian(['85'], '', $tgl);
                    $wasteWtpIe = $this->rasioBagian(['86'], '', $tgl);
                    $wasteWtpRecycle = $this->rasioBagian(['87'], '', $tgl);        
                    $waterRecycleRate = $this->rasioBagian(['92', '93'], '', $tgl);
                    if($waterRecycleRate == '0'){
                        $waterRecycleRate = 0;
                    }else{
                        $cekcek = $this->rasioBagian(['92', '93'], '', $tgl);
                        if($cekcek == 0){
                            $waterRecycleRate = 0;
                        }else{
                            $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                        }
                    }
                    
                    // NFI
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);        
                    $serviceWater = $this->rasioBagian(['101'], 'NFI', $tgl);        
                    // HNI
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
            
                    // Demin Water Boiler
                    //  Boiler - Ruby
                    // Boiler - Greek
                    // Boiler - Retort
            
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);        
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    
                    // ================================= Gas =========================
                    $nm3 = $this->rasioBagian(['108'], '', $tgl);        
                    $mmbtu = $this->rasioBagian(['109'], '', $tgl);        
                    $plantSolar = $this->rasioBagian(['110'], '', $tgl);        
                    $gasBoiler10Ton = $this->rasioBagian(['111'], '', $tgl);                    
                    $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                    $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                    $nfiProduksi = $nm3 - $gasBoiler10Ton;
                    $plantHeader = $this->rasioBagian(['112'], '', $tgl);        
                    $hniRuby = $this->rasioBagian(['113'], '', $tgl);        
                    $hniGreek = $this->rasioBagian(['114'], '', $tgl);                    
                    $hniRubySteam = $plantHeader - $hniRuby;
                    $hniRetort = $this->rasioBagian(['115'], '', $tgl);        
                    
                    if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                        $hniGreekGas = 0;            
                        $hniRetortGas = 0;
                        $hniProduksiSolar = 0;
                    }else{
                        $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                        $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
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
                // End report 3
                
                // Report 4
                    $frc1 = $this->rasioBagian(['38'], 'NFI', $tgl);
                    $frc2 = $this->rasioBagian(['72', '73'], 'NFI', $tgl);
                    $frc = $frc1 - $frc2;
                    $lab = $this->rasioBagian(['39'], 'NFI', $tgl);    
                    // Wtp dan wwtp
                    // Deepwell
                    // Utility Total
                    $nfiVarLoad = $frc + $lab;
    
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $lpgp = $this->rasioBagian(['58'], 'NFI', $tgl);
                    $ac1 = $this->rasioBagian(['55'], 'NFI', $tgl);
                    $ac2 = $this->rasioBagian(['56'], 'NFI', $tgl);
                    $ac = $ac1 - $ac2;
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl) / 4;
                    $hydrant = $this->rasioBagian(['46'], 'NFI', $tgl);
                    $ruby = $this->rasioBagian(['72', '73'], 'HNI', $tgl);
                    if($frc + $ruby == 0){
                        $fr = 1;
                    }else{
                        $fr = $frc + $ruby;
                    }
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($frc/$fr)* $ups;
                    $nfiFixLoad = $lpgp + $ac + $rc + $hydrant + $ruby + $upsRuby;
    
                    $greek = $this->rasioBagian(['43'], 'HNI', $tgl);
                    // WTR
                    // WTG
                    // DW2
                    $bakery = $this->rasioBagian(['57'], 'HNI', $tgl);
                    $hniVarLoad = $greek + $ruby + $bakery;
    
                    $officeRd = $this->rasioBagian(['42'], 'HNI', $tgl);
                    $acGudang = $this->rasioBagian(['6'], 'HNI', $tgl);
                    $rc = $this->rasioBagian(['48'], 'HNI', $tgl);
                    $rc1 = $this->rasioBagian(['49'], 'HNI', $tgl);
                    $rc = $rc + ($rc1 * 3 / 4);
                    // WTO
                    $ups1 = $this->rasioBagian(['37'], '', $tgl);
                    $ups2 = $this->rasioBagian(['38', '39', '72', '73'], '', $tgl);
                    $ups = $ups1 - $ups2;
                    $upsRuby = ($ruby / $fr) * $ups;
                    $hniFixLoad = ($officeRd + $acGudang + $rc) + $upsRuby;
    
                    // Demin Water Produksi
                    $dsw2 = $this->rasioBagian(['93'], '', $tgl);
                    $softWaterProduksi = $this->rasioBagian(['92', '93'], 'NFI', $tgl) - $this->rasioBagian(['95', '96', '97', '98', '99', '100'], 'NFI', $tgl);;
                    $softWaterNonProduksi = $this->rasioBagian(['95'], 'NFI', $tgl);
                    $softWaterLubrikasi = $this->rasioBagian(['99'], 'NFI', $tgl);    
                    // softwater cooling tower
                    $nfiVarLoadWater = $dsw2 + $softWaterProduksi + $softWaterNonProduksi + $softWaterLubrikasi;
                    
                    $nfiFixLoadWater = $this->rasioBagian(['101'], 'NFI', $tgl);
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);        
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);        
                    $hniVarloadWater = $deminWaterProdukHb + $softWaterProduksiHb + $softWaterGreek + $softWaterProduksiHb + $softWaterBakery;
    
                    $deminWaterRuby = $this->rasioBagian(['90'], 'HNI', $tgl);    
                    $softWaterRuby = $this->rasioBagian(['94'], 'HNI', $tgl);
                    // Demin Water Boiler
                    $rubyWater = $deminWaterRuby + $softWaterRuby;
    
                    $deminWaterGreek = $this->rasioBagian(['91'], 'HNI', $tgl);        
                    $softWaterGreek = $this->rasioBagian(['97'], 'HNI', $tgl);        
                    // Boiler Greek
                    $greekWater = $deminWaterGreek + $softWaterGreek;
    
                    $softWaterBakery = $this->rasioBagian(['102'], 'HNI', $tgl);
                    $softWaterGedungDepan = $this->rasioBagian(['96'], 'HNI', $tgl);
                    $softWaterHb = $this->rasioBagian(['98'], 'HNI', $tgl);
                // End Report 4
    
                $penggunaanGasNfi = $nfiProduksi; //Belum ditambah
                // NFI
                $nfi = $softWaterProduksi + $softWaterNonProduksi +$softWaterLubrikasi + $serviceWater;
                // HNI
                $hni = $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterRuby + $softWaterGreek + $softWaterProduksiHb;

                // Gas
                    // Dibagi Hari Kerja
                    array_push($bagian, ['bagian' => 'Production Usage per HK - NFI', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI GREEK', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RUBY', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                    array_push($bagian, ['bagian' => 'Production Usage per HK - HNI RETORT', 'satuan' => 'm3/day', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage NFI', 'satuan' => '%', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => '% Usage HNI', 'satuan' => '%', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase NFI', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Tonase HNI', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Greek', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'Ruby', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
                array_push($bagian, ['bagian' => 'RETORT', 'satuan' => 'm3/ton', 'nilai' => "BELUM", 'tgl_penggunaan' => $tgl]);
            }
        }
        
        return $bagian;
    }
}
 