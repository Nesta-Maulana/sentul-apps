<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use App\Models\utilityOnline\bagian;
use App\Models\masterApps\karyawan;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\penggunaan;
use \Carbon\Carbon;
use DB;
use Session;

class utilityOnlineGrafikController extends resourceController
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

    public function rasioBagianTahun($bagian, $company = "", $month){
        $nilai = 0;
        $cek = penggunaan::whereIn('id_bagian', $bagian)->whereMonth('tgl_penggunaan', $month)->get();
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

    // Return View

    public function report3GrafikPertahunBar(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        return view('utilityOnline.admin.reportGrafikBar', ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'bagian' => $bagian]);
    }

    public function reportGrafik(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        return view('utilityOnline.admin.reportGrafik', ['menus' => $this->menu, 'username' => $this->username,'kategori' => $kategori,'workcenter' => $workcenter, 'redirect' => null]);
    }
    public function reportGrafikPerhari(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        return view('utilityOnline.admin.reportGrafikPerhari', ['menus' => $this->menu, 'username' => $this->username,'kategori' => $kategori,'workcenter' => $workcenter, 'bagian' => $bagian]);
    }
    public function report3GrafikPerhari(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        
        return view('utilityOnline.admin.report3GrafikPerhari', ['menus' => $this->menu, 'username' => $this->username,'kategori' => $kategori,'workcenter' => $workcenter]);
    }

    // AJAX
    public function report3GrafikPertahunBarAjax($tahun, $kategori){
            $bagian = [
                "1" => [],
                "2" => [],
                "3" => [],
                "4" => [],
                "5" => [],
                "6" => [],
                "7" => [],
                "8" => [],
                "9" => [],
                "10" => [],
                "11" => [],
                "12" => [],

            ];
            for ($i=1; $i <= 12; $i++) { 
                if($kategori == 1){

                    // Rumus
                        $esdm = $this->rasioBagianTahun(['74', '75', '76', '77'], 'NFI', $i);       
                            
                        $inputRainWater = $this->rasioBagianTahun(['78'], '', $i);
                        $inputRawWater = $this->rasioBagianTahun(['79'], '', $i);
                        $inputProcessDemin = $this->rasioBagianTahun(['80'], '', $i);
                        $inputProcessSoft = $this->rasioBagianTahun(['81'], '', $i);
                        $inputEmbung = $this->rasioBagianTahun(['82'], '', $i);
                        $inputProcessRecycle = $this->rasioBagianTahun(['83'], '', $i);
                        $permeateRo = $this->rasioBagianTahun(['84'], '', $i);
                        $rejectWater = $this->rasioBagianTahun(['85'], '', $i);
                        $wasteWtpIe = $this->rasioBagianTahun(['86'], '', $i);
                        $wasteWtpRecycle = $this->rasioBagianTahun(['87'], '', $i);        
                        $waterRecycleRate = $this->rasioBagianTahun(['92', '93'], '', $i);
                        if($waterRecycleRate == '0'){
                            $waterRecycleRate = 0;
                        }else{
                            $cekcek = $this->rasioBagianTahun(['92', '93'], '', $i);
                            if($cekcek == 0){
                                $waterRecycleRate = 0;
                            }else{
                                $waterRecycleRate = $wasteWtpRecycle / $cekcek;
                            }
                        }
                        
                        // NFI
                        $softWaterProduksi = $this->rasioBagianTahun(['92', '93'], 'NFI', $i) - $this->rasioBagianTahun(['95', '96', '97', '98', '99', '100'], 'NFI', $i);;
                        $softWaterNonProduksi = $this->rasioBagianTahun(['95'], 'NFI', $i);        
                        $softWaterLubrikasi = $this->rasioBagianTahun(['99'], 'NFI', $i);        
                        $serviceWater = $this->rasioBagianTahun(['101'], 'NFI', $i);
                        $deminWaterProduksiNfi = $this->rasioBagianTahun(['118'], 'NFI', $i);
                        // HNI
                        $deminWaterRuby = $this->rasioBagianTahun(['90'], 'HNI', $i);        
                        $deminWaterGreek = $this->rasioBagianTahun(['91'], 'HNI', $i);        
                        $deminWaterProdukHb = $deminWaterRuby + $deminWaterGreek;
                        $softWaterRuby = $this->rasioBagianTahun(['94'], 'HNI', $i);        
                        $softWaterGreek = $this->rasioBagianTahun(['97'], 'HNI', $i);        
                        $softWaterProduksiHb = $softWaterRuby + $softWaterGreek;
                
                        // Demin Water Boiler
                        //  Boiler - Ruby
                        // Boiler - Greek
                        // Boiler - Retort
                
                        $softWaterGedungDepan = $this->rasioBagianTahun(['96'], 'HNI', $i);        
                        $softWaterHb = $this->rasioBagianTahun(['98'], 'HNI', $i);        
                        $softWaterGreek = $this->rasioBagianTahun(['97'], 'HNI', $i);        
                        $softWaterBakery = $this->rasioBagianTahun(['102'], 'HNI', $i);        
                    // End Rumus
                    array_push($bagian[$i], ['name' => 'ESDM', 'data' => [$esdm]]); 
                    array_push($bagian[$i], ['name' => 'Input Rain water WTP IE', 'data' => [$inputRainWater]]); 
                    array_push($bagian[$i], ['name' => 'Input Raw water WTP IE', 'data' => [$inputRawWater]]); 
                    array_push($bagian[$i], ['name' => 'Input process Demin', 'data' => [$inputProcessDemin]]); 
                    array_push($bagian[$i], ['name' => 'Input process Soft', 'data' => [$inputProcessSoft]]); 
                    array_push($bagian[$i], ['name' => 'Input Embung', 'data' => [$inputEmbung]]); 
                    array_push($bagian[$i], ['name' => 'Input Process Recycle', 'data' => [$inputProcessRecycle]]); 
                    array_push($bagian[$i], ['name' => 'Permeate RO ', 'data' => [$permeateRo]]); 
                    array_push($bagian[$i], ['name' => 'Reject Water', 'data' => [$rejectWater]]); 
                    array_push($bagian[$i], ['name' => 'Waste WTP IE', 'data' => [$wasteWtpIe]]); 
                    array_push($bagian[$i], ['name' => 'Waste WTP Recycle', 'data' => [$wasteWtpRecycle]]); 
                    array_push($bagian[$i], ['name' => 'Waste Recycle Rate', 'data' => [0]]); 
                    array_push($bagian[$i], ['name' => 'NFI (Water)', 'data' => [$inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater]]); 
                    array_push($bagian[$i], ['name' => 'Demin Water Produksi', 'data' => [$deminWaterProduksiNfi]]); 
                    array_push($bagian[$i], ['name' => 'Demin Water Boiler', 'data' => [$inputEmbung]]); 
                    array_push($bagian[$i], ['name' => 'Soft Water Produksi', 'data' => [$softWaterProduksi]]); 
                    array_push($bagian[$i], ['name' => 'Soft Water Non Produksi', 'data' => [$softWaterNonProduksi]]); 
                    array_push($bagian[$i], ['name' => 'Soft Water Lubrikasi', 'data' => [$softWaterLubrikasi]]); 
                    array_push($bagian[$i], ['name' => 'Soft Water Cooling Tower', 'data' => [$inputEmbung]]); 
                    array_push($bagian[$i], ['name' => 'Service Water', 'data' => [$serviceWater]]); 

                    // array_push($bagian[$i], ['name' => 'HNI', 'data' => [$deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery]]); 
                    // array_push($bagian[$i], ['name' => 'Demin Water Produksi', 'data' => [$deminWaterProdukHb]]); 
                    // array_push($bagian[$i], ['name' => 'Demin Water Ruby', 'data' => [$deminWaterRuby]]); 
                    // array_push($bagian[$i], ['name' => 'Demin Water Greek', 'data' => [$deminWaterGreek]]); 
                    // array_push($bagian[$i], ['name' => 'Soft Water Produksi', 'data' => [$softWaterProduksiHb]]); 
                    // array_push($bagian[$i], ['name' => 'Soft Water Ruby', 'data' => [$softWaterRuby]]); 
                    // array_push($bagian[$i], ['name' => 'Soft Water Greek', 'data' => [$softWaterGreek]]); 
                    
                    // array_push($bagian[$i], ['name' => 'Demin Water Boiler', 'data' => [$inputEmbung]]); 
                    // array_push($bagian[$i], ['name' => 'Boiler - Ruby', 'data' => [$inputEmbung]]); 
                    // array_push($bagian[$i], ['name' => 'Boiler - Greek', 'data' => [$inputEmbung]]); 
                    // array_push($bagian[$i], ['name' => 'Boiler - Retort', 'data' => [$inputEmbung]]); 
                    
                    // array_push($bagian[$i], ['name' => 'Soft Water Gedung Depan', 'data' => [$softWaterGedungDepan]]); 
                    // array_push($bagian[$i], ['name' => 'Soft Water HB', 'data' => [$softWaterHb]]); 
                    // array_push($bagian[$i], ['name' => 'Soft Water Bakery', 'data' => [$softWaterBakery]]); 

                    foreach ($bagian[$i] as $key => $row)
                    {
                        $vc_array_name[$key] = $row['data'][0];
                    }
                    array_multisort($vc_array_name, SORT_ASC, $bagian[$i]);
                
                }
                else if($kategori == 2){

                    // Rumus
                        $a = $this->rasioBagianTahun(['70','71'], '', $i);
                        
                        if($a == 0){
                            $lbwp = 0;
                            $wbp = 0;
                        }else{
                            $lbwp = $this->rasioBagianTahun(['70'], '', $i) / $a * 1;
                            $wbp = $this->rasioBagianTahun(['71'], '', $i) / $a * 100;    
                        }
                        $lpgp = $this->rasioBagianTahun(['58'], 'NFI', $i);
                        $ups1 = $this->rasioBagianTahun(['37'], '', $i);
                        $ups2 = $this->rasioBagianTahun(['38', '39', '72', '73'], '', $i);
                        $nfiTotal = $this->rasioBagianTahun(['44', '59', '60', '61', '62', '70', '71', '72', '73', '37', '38', '39', '40', '41', '42', '43', '56', '58', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '57'], 'NFI', $i);
                        $frc1 = $this->rasioBagianTahun(['38'], 'NFI', $i);
                        $frc2 = $this->rasioBagianTahun(['72', '73'], 'NFI', $i);
                        $lab = $this->rasioBagianTahun(['39'], 'NFI', $i);    
                        $ac1 = $this->rasioBagianTahun(['55'], 'NFI', $i);
                        $ac2 = $this->rasioBagianTahun(['56'], 'NFI', $i);
                        $rc1 = $this->rasioBagianTahun(['48'], 'NFI', $i);    
                        $hydrant = $this->rasioBagianTahun(['46'], 'NFI', $i);            
                        $ruby = $this->rasioBagianTahun(['72', '73'], 'HNI', $i);
                        $greek = $this->rasioBagianTahun(['43'], 'HNI', $i);
                        $bakery = $this->rasioBagianTahun(['57'], 'HNI', $i);
                        $officeRd = $this->rasioBagianTahun(['42'], 'HNI', $i);
                        $acGudang = $this->rasioBagianTahun(['6'], 'HNI', $i);
                        $rcHni = $this->rasioBagianTahun(['49'], 'HNI', $i);
                        $rc = $this->rasioBagianTahun(['48'], 'HNI', $i);
                        $boiler = $this->rasioBagianTahun(['51'], 'HNI', $i) * 3 / 4;
                        $chiller = $this->rasioBagianTahun(['52', '53'], 'HNI', $i);                
                        $compressor = $this->rasioBagianTahun(['54'], 'HNI', $i);
                        $coolingTowers = $this->rasioBagianTahun(['69'], 'NFI', $i);
                        $coolingTower =  $coolingTowers - $this->rasioBagianTahun(['51', '52', '53', '54'], 'NFI', $i);
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
                    // End Rumus
        
                    array_push($bagian[$i], ['name' => 'PLN', 'data' => [$a * 3.2]]); 
                    array_push($bagian[$i], ['name' => 'LWBP', 'data' => [$lbwp]]); 
                    array_push($bagian[$i], ['name' => 'WBP', 'data' => [$wbp,]]); 
                    array_push($bagian[$i], ['name' => 'UPS Charging', 'data' => [$ups]]); 
                    array_push($bagian[$i], ['name' => 'NFI TOTAl', 'data' => [$nfiTotal]]); 
                    array_push($bagian[$i], ['name' => 'FRC', 'data' => [$frc]]); 
                    array_push($bagian[$i], ['name' => 'UPS FRC', 'data' => [($frc/$fr)* $ups]]); 
                    array_push($bagian[$i], ['name' => 'LAB', 'data' => [$lab]]); 
                    // 'WTP & WWTP'
                    array_push($bagian[$i], ['name' => 'LPGP', 'data' => [$lpgp]]); 
                    array_push($bagian[$i], ['name' => 'AC', 'data' => [$ac1 - $ac2]]); 
                    array_push($bagian[$i],  ['name' => 'RC', 'data' => [$rc1]]); 
                    array_push($bagian[$i], ['name' => 'HYDRANT', 'data' => [$hydrant]]); 
                    // 'DEEPWELL' => penggunaan::where
                    // 'UTILITY TOTAL'
                    // 'Boiler'
                    array_push($bagian[$i],  ['name' => 'Chiller', 'data' => [$chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller]]); 
                    array_push($bagian[$i], ['name' => 'Compressor', 'data' => [$compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor)]]); 
                    array_push($bagian[$i], ['name' => 'Cooling Tower', 'data' => [$coolingTower]]); 
                    // 'HNI TOTAL'
                    // // 'PRODUKSI'
                    // array_push($bagian[$i], ['name' => 'RUBY', 'data' => [$ruby]]); 
                    // array_push($bagian[$i], ['name' => 'UPS RUBY', 'data' => [($ruby / $fr) * $ups]]); 
                    // array_push($bagian[$i], ['name' => 'GREEK', 'data' => [$greek]]); 
                    // array_push($bagian[$i], ['name' => 'BAKERY', 'data' => [$bakery]]); 
                    // array_push($bagian[$i], ['name' => 'OFFICE-RD', 'data' => [$officeRd]]); 
                    // array_push($bagian[$i], ['name' => 'AC GUDANG', 'data' => [$acGudang]]); 
                    // // 'WTP & WWTP'
                    // 'RUBY'
                    // 'GREEK'
                    // 'Non-Produksi'
                    // array_push($bagian[$i], ['name' => 'RC', 'data' => [$rc]]); 
                    // // 'DEEPWELL'
                    // // 'UTILITY'
                    // // 'RUBY Utility'
                    // // 'Boiler' => ($ruby/$rgf) * $chiller,
                    // array_push($bagian[$i], ['name' => 'Chiller', 'data' => [($ruby/$rgf) * $chiller]]); 
                    // array_push($bagian[$i], ['name' => 'Compressor', 'data' => [($ruby/$rgf) * $compressor]]); 
                    // array_push($bagian[$i], ['name' => 'Colling Tower', 'data' => [($ruby/$rgf) * $coolingTower]]); 
                    // // 'GREEK  Utility'
                    // // 'Boiler'
                    // array_push($bagian[$i], ['name' => 'Chiller', 'data' => [($greek/$rgf) * $chiller]]); 
                    // array_push($bagian[$i], ['name' => 'Compressor', 'data' => [($greek/$rgf) * $compressor]]); 
                    // array_push($bagian[$i], ['name' => 'Colling Tower', 'data' => [($greek/$rgf) * ($greek/$rgf) * $coolingTower]]); 
                    foreach ($bagian[$i] as $key => $row)
                    {
                        $vc_array_name[$key] = $row['data'][0];
                    }
                    array_multisort($vc_array_name, SORT_ASC, $bagian[$i]);
                }
                else if($kategori == 3){
                    // Rumus
                        $nm3 = $this->rasioBagianTahun(['108'], '', $i);        
                        $mmbtu = $this->rasioBagianTahun(['109'], '', $i);        
                        $plantSolar = $this->rasioBagianTahun(['110'], '', $i);        
                        $gasBoiler10Ton = $this->rasioBagianTahun(['111'], '', $i);                    
                        $gasBoiler10Ton = (3.81 * $gasBoiler10Ton * 288) / (1.01 * 298);
                        $gasBoiler5Ton = $nm3 - $gasBoiler10Ton;
                        $nfiProduksi = $nm3 - $gasBoiler10Ton;
                        $plantHeader = $this->rasioBagianTahun(['112'], '', $i);        
                        $hniRuby = $this->rasioBagianTahun(['113'], '', $i);        
                        $hniGreek = $this->rasioBagianTahun(['114'], '', $i);                    
                        $hniRubySteam = $plantHeader - $hniRuby;
                        $hniRetort = $this->rasioBagianTahun(['115'], '', $i);        
                        
                        if($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi == 0){
                            $hniGreekGas = 0;            
                            $hniRetortGas = 0;
                            $hniProduksiSolar = 0;
                        }else{
                            $hniGreekGas = ($hniGreek / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                            $hniRetortGas = ($hniRetort / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi)) * $nm3;
                            $hniProduksiSolar = ($hniGreek + $hniRubySteam + $hniRetort) / ($hniGreek + $hniRubySteam + $hniRetort + $nfiProduksi) * $plantSolar;
                        }
                    // End Rumus
                    array_push($bagian[$i], ['name' => 'PGN MRS', 'data' => ["0"], 'satuan' => 'nm3']); 
                    array_push($bagian[$i], ['name' => 'nm3', 'data' => [$nm3], 'satuan' => 'nm3']); 
                    array_push($bagian[$i], ['name' => 'MMBTU', 'data' => [$mmbtu], 'satuan' => 'MMBTU']); 
                    array_push($bagian[$i], ['name' => 'PLANT SOLAR', 'data' => [$plantSolar], 'satuan' => 'm3']); 
                    array_push($bagian[$i], ['name' => 'GAS BOILER 10 TON', 'data' => [$gasBoiler10Ton], 'satuan' => 'nm3']); 
                    array_push($bagian[$i], ['name' => 'GAS BOILER 5 TON', 'data' => [$gasBoiler5Ton], 'satuan' => 'nm3']); 
                    array_push($bagian[$i], ['name' => 'NFI (GAS)', 'data' => ["0"], 'satuan' => 'm3']); 
                    array_push($bagian[$i], ['name' => 'NFI PRODUKSI (STEAM)', 'data' => [$nfiProduksi], 'satuan' => 'kg']); 
                    array_push($bagian[$i], ['name' => 'NFI PRODUKSI (GAS)', 'data' => ["0"], 'satuan' => 'nm3']); 
                    array_push($bagian[$i], ['name' => 'NFI PRODUKSI (SOLAR)', 'data' => ["0"], 'satuan' => 'nm3']); 
                    // array_push($bagian[$i], ['name' => 'HNI (GAS)', 'data' => ["0"], 'satuan' => 'm3']); 
                    // array_push($bagian[$i], ['name' => 'HNI RUBY (STEAM)', 'data' => [$hniRubySteam], 'satuan' => 'kg']); 
                    // array_push($bagian[$i], ['name' => 'HNI GREEK (STEAM)', 'data' => [$hniGreekGas], 'satuan' => 'kg']); 
                    // array_push($bagian[$i], ['name' => 'HNI RETORT (STEAM)', 'data' => [$hniRetortGas], 'satuan' => 'kg']); 
                    // array_push($bagian[$i], ['name' => 'HNI RUBY (GAS)', 'data' => [$hniRuby], 'satuan' => 'nm3']); 
                    // array_push($bagian[$i], ['name' => 'HNI GREEK (GAS)', 'data' => [$hniGreekGas], 'satuan' => 'nm3']); 
                    // array_push($bagian[$i], ['name' => 'HNI RETORT (GAS)', 'data' => [$hniRetortGas], 'satuan' => 'nm3']); 
                    // array_push($bagian[$i], ['name' => 'HNI PRODUKSI (SOLAR)', 'data' => [$hniProduksiSolar], 'satuan' => 'nm3']); 
                    foreach ($bagian[$i] as $key => $row)
                    {
                        $vc_array_name[$key] = $row['data'][0];
                    }
                    array_multisort($vc_array_name, SORT_ASC, $bagian[$i]);
                }
            }

            return [$bagian];
    }

    public function pengunaanPertahun($tahun, $id){
        $bagians    = bagian::where('workcenter_id', $id)->get();
        $nilai = [];
        $i = 0;
        for ($bulan=1; $bulan <= 12; $bulan++) { 
            $isiBulan = [
                $bulan
            ];
            array_push($nilai, $isiBulan);
            foreach ($bagians as $bagian ) {
                $penggunaan = penggunaan::where('id_bagian', $bagian->id)->selectRaw('sum(nilai) as data')->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->first();
                array_push($nilai[$i], $penggunaan->data);
            }
            $i ++;
        }

        return [$bagians, $nilai];
    }
    public function penggunaanPerhari($tahun, $bulan, $id){
        $bagians = bagian::where('id', $id)->first();

        $tz = 'Asia/Jakarta';
        $from = Carbon::createFromDate($tahun, $bulan, "01", $tz);
        $to = Carbon::createFromDate($tahun, $bulan, "01", $tz);
        $from = $from->startOfMonth();
        $to = $to->endOfMonth();
        $dateRange = $this->generateDateRange($from, $to);
        $bagiannya = array();
        foreach ($dateRange as $d ) {
            $nilai = penggunaan::where('id_bagian', $id)->selectRaw('sum(nilai) as data')->where('tgl_penggunaan', $d)->first();
            array_push($bagiannya,$nilai->data);
        }
        $bagians->name = $bagians->bagian;
        $bagians->data = $bagiannya;
        return [$bagians];
    }
    public function penggunaanPerbulanBagian($bagian, $bulan, $tahun){
        $bagians = bagian::where('bagian', $bagian)->latest()->first();
        $idBagian = $bagians->id;
        $workcenterSelected = workcenter::find($bagians->workcenter_id);
        $kategoriSelected = kategori::find($workcenterSelected->kategori_id);
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $tz = 'Asia/Jakarta';
        $from = Carbon::createFromDate($tahun, $bulan, "01", $tz);
        $to = Carbon::createFromDate($tahun, $bulan, "01", $tz);
        $from = $from->startOfMonth();
        $to = $to->endOfMonth();
        $dateRange = $this->generateDateRange($from, $to);
        $bagiannya = array();
        foreach ($dateRange as $d ) {
            $nilai = penggunaan::where('id_bagian', $idBagian)->selectRaw('sum(nilai) as data')->where('tgl_penggunaan', $d)->first();
            array_push($bagiannya,$nilai->data);
        }
        $bagians->name = $bagians->bagian;
        $bagians->data = $bagiannya;
        $allBagian = bagian::all();
        return view('utilityOnline.admin.reportGrafikPerhari', ['menus' => $this->menu, 'username' => $this->username,'kategori' => $kategori,'workcenter' => $workcenter,'allBagian' => $allBagian, 'bagian' => $bagian, 'tahun' => $tahun, 'bulan' => $bulan, "idBagian" => $idBagian,"workcenterSelected" => $workcenterSelected, "kategoriSelected" => $kategoriSelected, "redirect" => 'Oke']);
    }
    public function optionReport3Bagian($id){
        if($id == 1){
            $bagian = [
                'ESDM',
                'Input Rain water WTP IE',
                'Input Raw water WTP IE',
                'Input process Demin',
                'Input process Soft',
                'Input Embung',
                'Input Process Recycle',
                'Permeate RO ',
                'Reject Water',
                'Waste WTP IE',
                'Waste WTP Recycle',
                'Waste Recycle Rate',
                'NFI (Water)',
                'Demin Water Produksi',
                'Demin Water Boiler',
                'Soft Water Produksi',
                'Soft Water Non Produksi',
                'Soft Water Lubrikasi',
                'Soft Water Cooling Tower',
                'Service Water',
                'HNI',
                'Demin Water Produksi',
                'Demin Water Ruby',
                'Demin Water Greek',
                'Soft Water Produksi',
                'Soft Water Ruby',
                'Soft Water Greek',
                'Demin Water Boiler',
                'Boiler - Ruby',
                'Boiler - Greek',
                'Boiler - Retort',
                'Soft Water Gedung Depan',
                'Soft Water HB',
                'Soft Water Bakery',
            ];
        }else if ($id == 2){
            $bagian = [
                'PLN',
                'LWBP',
                'WBP',
                'UPS Charging',
                'NFI TOTAl',
                'FRC',
                'UPS FRC',
                'LAB',
                'WTP & WWTP',
                'LPGP',
                'AC',
                'RC',
                'HYDRANT',
                'DEEPWELL',
                'UTILITY TOTAL',
                'Boiler',
                'Chiller',
                'Compressor',
                'Cooling Tower',
                'HNI TOTAL',
                'PRODUKSI',
                'RUBY',
                'UPS RUBY',
                'GREEK',
                'BAKERY',
                'OFFICE-RD',
                'AC GUDANG',
                'WTP & WWTP',
                'RUBY',
                'GREEK',
                'Non-Produksi',
                'RC',
                'DEEPWELL',
                'UTILITY',
                'RUBY Utility',
                'Boiler',
                'Chiller',
                'Compressor',
                'Colling Tower',
                'GREEK  Utility',
                'Boiler',
                'Chiller',
                'Compressor',
                'Colling Tower',
            ];
        }else if($id == 3){
            $bagian = [
                'PGN MRS',
                'nm3',
                'MMBTU',
                'PLANT SOLAR',
                'GAS BOILER 10 TON',
                'GAS BOILER 5 TON',
                'NFI (GAS)',
                'NFI PRODUKSI (STEAM)',
                'NFI PRODUKSI (GAS)',
                'NFI PRODUKSI (SOLAR)',
                'HNI (GAS)',
                'HNI RUBY (STEAM)',
                'HNI GREEK (STEAM)',
                'HNI RETORT (STEAM)',
                'HNI RUBY (GAS)',
                'HNI GREEK (GAS)',
                'HNI RETORT (GAS)',
                'HNI PRODUKSI (SOLAR)',
            ];
        }
        return $bagian;
    }
    public function report3Perhari($tahun, $bulan, $id){
        $tz = 'Asia/Jakarta';
        $from = Carbon::createFromDate($tahun, $bulan, "01", $tz);
        $to = Carbon::createFromDate($tahun, $bulan, "01", $tz);
        $from = $from->startOfMonth();
        $to = $to->endOfMonth();
        $dateRange = $this->generateDateRange($from, $to);
        $nilai = array();
        $bagian = [
            "name" => $id,
        ];
        foreach ($dateRange as $tgl) {
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

            // Add Array
            if($id == 'ESDM'){
                array_push($nilai, $esdm); 
            }
            else if($id == 'Input Rain water WTP IE'){
                array_push($nilai,$inputRainWater);
            }
            else if($id == 'Input Raw water WTP IE'){
                array_push($nilai,$inputRawWater);
            }
            else if($id == 'Input process Demin'){
                array_push($nilai,$inputProcessDemin);
            }
            else if($id == 'Input process Soft'){
                array_push($nilai,$inputProcessSoft);
            }
            else if($id == 'Input Embung'){
                array_push($nilai,$inputEmbung);
            }
            else if($id == 'Input Process Recycle'){
                array_push($nilai,$inputProcessRecycle);
            }
            else if($id == 'Permeate RO '){
                array_push($nilai,$permeateRo);
            }
            else if($id == 'Reject Water'){
                array_push($nilai,$rejectWater);
            }
            else if($id == 'Waste WTP IE'){
                array_push($nilai,$wasteWtpIe);
            }
            else if($id == 'Waste WTP Recycle'){
                array_push($nilai,$wasteWtpRecycle);
            }
            else if($id == 'Waste Recycle Rate'){
                array_push($nilai,$waterRecycleRate);
            }
            else if($id == 'NFI (Water)'){
                array_push($nilai,$inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater);
            }
            else if($id == 'Demin Water Produksi'){
                array_push($nilai,$inputEmbung);
            }
            else if($id == 'Demin Water Boiler'){
                array_push($nilai, $inputEmbung);
            }
            else if($id == 'Soft Water Produksi'){
                array_push($nilai,$softWaterProduksi);
            }
            else if($id == 'Soft Water Non Produksi'){
                array_push($nilai,$softWaterNonProduksi);
            }
            else if($id == 'Soft Water Lubrikasi'){
                array_push($nilai, $softWaterLubrikasi);
            }
            else if($id == 'Soft Water Cooling Tower'){
                array_push($nilai, $inputEmbung);
            }
            else if($id == 'Service Water'){
                array_push($nilai, $serviceWater);
            }
            else if($id == 'HNI'){
                array_push($nilai, $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery);
            }
            else if($id == 'Demin Water Produksi'){
                array_push($nilai, $deminWaterProdukHb);
            }
            else if($id == 'Demin Water Ruby'){
                array_push($nilai, $deminWaterRuby);
            }
            else if($id == 'Demin Water Greek'){
                array_push($nilai, $deminWaterGreek);
            }
            else if($id == 'Soft Water Produksi'){
                array_push($nilai, $softWaterProduksiHb);
            }
            else if($id == 'Soft Water Ruby'){
                array_push($nilai, $softWaterRuby);
            }
            else if($id == 'Soft Water Greek'){
                array_push($nilai, $softWaterGreek);
            }
            else if($id == 'Demin Water Boiler'){
                array_push($nilai, $inputEmbung);
            }
            else if($id == 'Boiler - Ruby'){
                array_push($nilai, $inputEmbung);
            }
            else if($id == 'Boiler - Greek'){
                array_push($nilai, $inputEmbung);
            }
            else if($id == 'Boiler - Retort'){
                array_push($nilai, $inputEmbung);
            }
            else if($id == 'Soft Water Gedung Depan'){
                array_push($nilai, $softWaterGedungDepan);
            }
            else if($id == 'Soft Water HB'){
                array_push($nilai, $softWaterHb);
            }
            else if($id == 'Soft Water Bakery'){
                array_push($nilai, $softWaterBakery);
            }
            else if($id == 'PLN'){
                array_push($nilai, $a * 3.2);
            }
            else if($id == 'LWBP'){
                array_push($nilai, $lbwp);
            }
            else if($id == 'WBP'){
                array_push($nilai,$wbp); 
            }
            else if($id == 'UPS Charging'){
                array_push($nilai, $ups);
            }
            else if($id == 'NFI TOTAl'){
                array_push($nilai, $nfiTotal);
            }
            else if($id == 'FRC'){
                array_push($nilai, $frc);
            }
            else if($id == 'UPS FRC'){
                array_push($nilai, ($frc/$fr)* $ups);
            }
            else if($id == 'LAB'){
                array_push($nilai, $lab);
            }
            else if($id == 'WTP & WWTP'){
                array_push($nilai, " ");
            }
            else if($id == 'LPGP'){
                array_push($nilai, $lpgp);
            }
            else if($id == 'AC'){
                array_push($nilai, $ac1 - $ac2);
            }
            else if($id == 'RC'){
                array_push($nilai, $rc1);
            }
            else if($id == 'HYDRANT'){
                array_push($nilai, $hydrant);
            }
            else if($id == 'DEEPWELL'){
                array_push($nilai, " ");
            }
            else if($id == 'UTILITY TOTAL'){
                array_push($nilai, " ");
            }
            else if($id == 'Boiler'){
                array_push($nilai, " ");
            }
            else if($id == 'Chiller'){
                array_push($nilai, $chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller);
            }
            else if($id == 'Compressor'){
                array_push($nilai, $compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor));
            }
            else if($id == 'Cooling Tower'){
                array_push($nilai, $coolingTower);
            }
            else if($id == 'HNI TOTAL'){
                array_push($nilai, $coolingTower);
            }
            else if($id == 'PRODUKSI'){
                array_push($nilai, $coolingTower);
            }
            else if($id == 'RUBY'){
                array_push($nilai, $ruby);
            }
            else if($id == 'UPS RUBY'){
                array_push($nilai, ($ruby / $fr) * $ups);
            }
            else if($id == 'GREEK'){
                array_push($nilai, $greek);
            }
            else if($id == 'BAKERY'){
                array_push($nilai, $bakery);
            }
            else if($id == 'OFFICE-RD'){
                array_push($nilai, $officeRd);
            }
            else if($id == 'AC GUDANG'){
                array_push($nilai, $acGudang);
            }
            else if($id == 'WTP & WWTP'){
                array_push($nilai, " ");
            }
            else if($id == 'RUBY'){
                array_push($nilai, " ");
            }
            else if($id == 'GREEK'){
                array_push($nilai, " ");
            }
            else if($id == 'Non-Produksi'){
                array_push($nilai, " ");
            }
            else if($id == 'RC'){
                array_push($nilai, $rc);
            }
            else if($id == 'DEEPWELL'){
                array_push($nilai, " ");
            }
            else if($id == 'UTILITY'){
                array_push($nilai, " ");
            }
            else if($id == 'RUBY Utility'){
                array_push($nilai, " ");
            }
            else if($id == 'Boiler'){
                array_push($nilai, " ");
            }
            else if($id == 'Chiller'){
                array_push($nilai, ($ruby/$rgf) * $chiller);
            }
            else if($id == 'Compressor'){
                array_push($nilai, ($ruby/$rgf) * $compressor);
            }
            else if($id == 'Colling Tower'){
                array_push($nilai, ($ruby/$rgf) * $coolingTower);
            }
            else if($id == 'GREEK  Utility'){
                array_push($nilai, ($ruby/$rgf) * $coolingTower);
            }
            else if($id == 'Boiler'){
                array_push($nilai, ($ruby/$rgf) * $coolingTower);
            }
            else if($id == 'Chiller'){
                array_push($nilai, ($greek/$rgf) * $chiller);
            }
            else if($id == 'Compressor'){
                array_push($nilai, ($greek/$rgf) * $compressor);
            }
            else if($id == 'Colling Tower'){
                array_push($nilai, ($greek/$rgf) * ($greek/$rgf) * $coolingTower);
            }
            else if($id == 'PGN MRS'){
                array_push($nilai, "Belum");
            }
            else if($id == 'nm3'){
                array_push($nilai, $nm3);
            }
            else if($id == 'MMBTU'){
                array_push($nilai, $mmbtu);
            }
            else if($id == 'PLANT SOLAR'){
                array_push($nilai,$plantSolar);
            }
            else if($id == 'GAS BOILER 10 TON'){
                array_push($nilai, $gasBoiler10Ton);
            }
            else if($id == 'GAS BOILER 5 TON'){
                array_push($nilai, $gasBoiler5Ton);
            }
            else if($id == 'NFI (GAS)'){
                array_push($nilai, "Belum");
            }
            else if($id == 'NFI PRODUKSI (STEAM)'){
                array_push($nilai, $nfiProduksi);
            }
            else if($id == 'NFI PRODUKSI (GAS)'){
                array_push($nilai, "Belum");
            }
            else if($id == 'NFI PRODUKSI (SOLAR)'){
                array_push($nilai, "Belum");
            }
            else if($id == 'HNI (GAS)'){
                array_push($nilai, "Belum");
            }
            else if($id == 'HNI RUBY (STEAM)'){
                array_push($nilai,$hniRubySteam);
            }
            else if($id == 'HNI GREEK (STEAM)'){
                array_push($nilai, $hniGreekGas);
            }
            else if($id == 'HNI RETORT (STEAM)'){
                array_push($nilai, $hniRetortGas);
            }
            else if($id == 'HNI RUBY (GAS)'){
                array_push($nilai, $hniRuby);
            }
            else if($id == 'HNI GREEK (GAS)'){
                array_push($nilai, $hniGreekGas);
            }
            else if($id == 'HNI RETORT (GAS)'){
                array_push($nilai, $hniRetortGas);
            }
            else if($id == 'HNI PRODUKSI (SOLAR)'){
                array_push($nilai, $hniProduksiSolar);
            }
        }
        $bagian = [
            'name' => $id,
            'data' => $nilai
        ];
        return [$bagian];
    }
    
}

