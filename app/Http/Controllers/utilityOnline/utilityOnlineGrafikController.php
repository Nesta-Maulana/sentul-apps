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

    // Return View

    public function reportGrafik(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        return view('utilityOnline.admin.reportGrafik', ['menus' => $this->menu, 'username' => $this->username,'kategori' => $kategori,'workcenter' => $workcenter]);
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

    public function pengunaanPertahun($tahun, $id){
        $bagians = bagian::where('workcenter_id', $id)->get();
        foreach ($bagians as $bagian ) {
            $bagiannya = array();
            
            for ($i=1; $i <= 12; $i++) { 
                $nilai = penggunaan::where('id_bagian', $bagian->id)->selectRaw('sum(nilai) as data')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->first();
                array_push($bagiannya,$nilai->data);
                $bagian->name = $bagian->bagian;
            }
            $bagian->data = $bagiannya;
            $bagian->link = 'http://localhost/sentul-apps/utility-online/admin/report-penggunaan/' . $bagian->id;
            // dd($bagian->url);
        }

        return $bagians;
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
