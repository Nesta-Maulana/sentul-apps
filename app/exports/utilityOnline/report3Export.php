<?php

namespace App\exports\utilityOnline;

use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\bagian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use \Carbon\Carbon;

class report3Export implements FromView, WithHeadings, ShouldAutoSize
{
    use Exportable; 

    public function __construct(string $tgl1, string $tgl2, string $kategori){
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
        $this->kategori = $kategori;
    }
    public function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        $this->jmlDate = 0;
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
            $this->jmlDate++;
        }
        return $dates;
    }    
    public function rasioBagian($bagian, $company = "", $tgl){
        $nilai = 0;
        $cek = penggunaan::whereIn('id_bagian', $bagian)->where('tgl_penggunaan', $tgl)->get();
        foreach ($cek as $penggunaan) {
            if(!$penggunaan->bagian->rasioHead){
                $nilaiBagian = $penggunaan->nilai;
                $nilai =  $nilai + $nilaiBagian;
            }else{
                foreach ($penggunaan->bagian->rasioHead->rasioDetail as $rasioDetail) {                
                    if ($rasioDetail->company->singkatan == $company) {
                        $nilaiPenggunaan = $penggunaan->nilai;
                        $rasio = $rasioDetail->nilai/100;
                        $nilaiBagian = $penggunaan->nilai * $rasio;
                        $nilai =  $nilai + $nilaiBagian;
                    }else{
                        $nilaiBagian = $penggunaan->nilai;
                        $nilai =  $nilai + $nilaiBagian;
                    }
                }
            }
        }
            return $nilai;
    }
    public function headings(): array
    {

    }
    public function view(): View
    {
        if($this->tgl1 == "" && $this->tgl2 == ""){
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
            $from1 = explode('-', $this->tgl1);
            $to1 = explode('-', $this->tgl2);
            
            $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
            $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
            $cek = $this->generateDateRange($from1, $to1);  
            $no = 0;
            foreach ($cek as $c ) {
                $no++;
            }
        }
        if($this->kategori == '1'){
            $bagian = [
                0 =>['bagian' => 'ESDM', 'satuan' => 'm3', 'nilai' => []], 
                1 =>['bagian' => 'Input Rain water WTP IE', 'satuan' => 'm3', 'nilai' => []], 
                2 =>['bagian' => 'Input Raw water WTP IE', 'satuan' => 'm3', 'nilai' => []], 
                3 =>['bagian' => 'Input process Demin', 'satuan' => 'm3', 'nilai' => []], 
                4 =>['bagian' => 'Input process Soft', 'satuan' => 'm3', 'nilai' => []], 
                5 =>['bagian' => 'Input Embung', 'satuan' => 'm3', 'nilai' => []], 
                6 =>['bagian' => 'Input Process Recycle', 'satuan' => 'm3', 'nilai' => []], 
                7 =>['bagian' => 'Permeate RO ', 'satuan' => 'm3', 'nilai' => []], 
                8 =>['bagian' => 'Reject Water', 'satuan' => 'm3', 'nilai' => []], 
                9 =>['bagian' => 'Waste WTP IE', 'satuan' => 'm3', 'nilai' => []], 
                10 =>['bagian' => 'Waste WTP Recycle', 'satuan' => 'm3', 'nilai' => []], 
                11 =>['bagian' => 'Waste Recycle Rate', 'satuan' => 'm3', 'nilai' => []], 
                12 =>['bagian' => 'Demin Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                13 =>['bagian' => 'Demin Water Boiler', 'satuan' => 'm3', 'nilai' => []], 
                14 =>['bagian' => 'Soft Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                15 =>['bagian' => 'Soft Water Non Produksi', 'satuan' => 'm3', 'nilai' => []], 
                16 =>['bagian' => 'Soft Water Lubrikasi', 'satuan' => 'm3', 'nilai' => []], 
                17 =>['bagian' => 'Soft Water Cooling Tower', 'satuan' => 'm3', 'nilai' => []], 
                18 =>['bagian' => 'Service Water', 'satuan' => 'm3', 'nilai' => []], 
                19 =>['bagian' => 'HNI', 'satuan' => 'm3', 'nilai' => []], 
                20 =>['bagian' => 'Demin Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                21 =>['bagian' => 'Demin Water Ruby', 'satuan' => 'm3', 'nilai' => []], 
                22 =>['bagian' => 'Demin Water Greek', 'satuan' => 'm3', 'nilai' => []], 
                23 =>['bagian' => 'Soft Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                24 =>['bagian' => 'Soft Water Ruby', 'satuan' => 'm3', 'nilai' => []], 
                25 =>['bagian' => 'Soft Water Greek', 'satuan' => 'm3', 'nilai' => []], 
                26 =>['bagian' => 'Demin Water Boiler', 'satuan' => 'm3', 'nilai' => []], 
                27 =>['bagian' => 'Boiler - Ruby', 'satuan' => 'm3', 'nilai' => []], 
                28 =>['bagian' => 'Boiler - Greek', 'satuan' => 'm3', 'nilai' => []], 
                29 =>['bagian' => 'Boiler - Retort', 'satuan' => 'm3', 'nilai' => []], 
                30 =>['bagian' => 'Soft Water Gedung Depan', 'satuan' => 'm3', 'nilai' => []], 
                31 =>['bagian' => 'Soft Water HB', 'satuan' => 'm3', 'nilai' => []], 
                32 =>['bagian' => 'Soft Water Bakery', 'satuan' => 'm3', 'nilai' => []], 
            ];
            for ($i=0; $i < $no; $i++) { 
                $tgl = $cek[$i];
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
                
                // ==== Array Push ====

                
                array_push($bagian[0]['nilai'], ['bagian' => 'ESDM', 'nilai' => $esdm, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[1]['nilai'], ['bagian' => 'Input Rain water WTP IE', 'nilai' => $inputRainWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[2]['nilai'], ['bagian' => 'Input Raw water WTP IE', 'nilai' => $inputRawWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[3]['nilai'], ['bagian' => 'Input process Demin', 'nilai' => $inputProcessDemin, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[4]['nilai'], ['bagian' => 'Input process Soft', 'nilai' => $inputProcessSoft, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[5]['nilai'], ['bagian' => 'Input Embung', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[6]['nilai'], ['bagian' => 'Input Process Recycle', 'nilai' => $inputProcessRecycle, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[7]['nilai'], ['bagian' => 'Permeate RO ', 'nilai' => $permeateRo, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[8]['nilai'], ['bagian' => 'Reject Water', 'nilai' => $rejectWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[9]['nilai'], ['bagian' => 'Waste WTP IE', 'nilai' => $wasteWtpIe, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[10]['nilai'], ['bagian' => 'Waste WTP Recycle', 'nilai' => $wasteWtpRecycle, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[11]['nilai'], ['bagian' => 'Waste Recycle Rate', 'nilai' => $waterRecycleRate, 'tanggal_penggunaan' => $tgl]); 
                // NFI
                array_push($bagian[11]['nilai'], ['bagian' => 'NFI', 'nilai' => $inputEmbung + $inputEmbung + $softWaterProduksi + $softWaterLubrikasi + $inputEmbung + $softWaterNonProduksi + $serviceWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[12]['nilai'], ['bagian' => 'Demin Water Produksi', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[13]['nilai'], ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[14]['nilai'], ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[15]['nilai'], ['bagian' => 'Soft Water Non Produksi', 'nilai' => $softWaterNonProduksi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[16]['nilai'], ['bagian' => 'Soft Water Lubrikasi', 'nilai' => $softWaterLubrikasi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[17]['nilai'], ['bagian' => 'Soft Water Cooling Tower', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[18]['nilai'], ['bagian' => 'Service Water', 'nilai' => $serviceWater, 'tanggal_penggunaan' => $tgl]); 
                // // HNI
                array_push($bagian[19]['nilai'], ['bagian' => 'HNI', 'nilai' => $deminWaterProdukHb + $deminWaterRuby + $deminWaterGreek + $softWaterProduksiHb + $softWaterRuby + $softWaterGreek + $inputEmbung + $inputEmbung + $inputEmbung + $inputEmbung + $softWaterGedungDepan + $softWaterHb + $softWaterBakery, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[20]['nilai'], ['bagian' => 'Demin Water Produksi', 'nilai' => $deminWaterProdukHb, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[21]['nilai'], ['bagian' => 'Demin Water Ruby', 'nilai' => $deminWaterRuby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[22]['nilai'], ['bagian' => 'Demin Water Greek', 'nilai' => $deminWaterGreek, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[23]['nilai'], ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksiHb, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[24]['nilai'], ['bagian' => 'Soft Water Ruby', 'nilai' => $softWaterRuby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[25]['nilai'], ['bagian' => 'Soft Water Greek', 'nilai' => $softWaterGreek, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[26]['nilai'], ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[27]['nilai'], ['bagian' => 'Boiler - Ruby', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[28]['nilai'], ['bagian' => 'Boiler - Greek', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[29]['nilai'], ['bagian' => 'Boiler - Retort', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[30]['nilai'], ['bagian' => 'Soft Water Gedung Depan', 'nilai' => $softWaterGedungDepan, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[31]['nilai'], ['bagian' => 'Soft Water HB', 'nilai' => $softWaterHb, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[32]['nilai'], ['bagian' => 'Soft Water Bakery', 'nilai' => $softWaterBakery, 'tanggal_penggunaan' => $tgl]); 
            }
        }
        else if($this->kategori == '2'){
            $bagian = [
                0 =>['bagian' => 'PLN', 'satuan' => 'Mwh', 'nilai' => []], 
                1 =>['bagian' => 'LWBP', 'satuan' => 'Mwh', 'nilai' => []], 
                2 =>['bagian' => 'WBP', 'satuan' => 'Mwh', 'nilai' => []], 
                3 =>['bagian' => 'UPS Charging', 'satuan' => 'Mwh', 'nilai' => []], 
                4 =>['bagian' => 'NFI TOTAl', 'satuan' => 'Mwh', 'nilai' => []], 
                5 =>['bagian' => 'FRC', 'satuan' => 'Mwh', 'nilai' => []], 
                6 =>['bagian' => 'UPS FRC', 'satuan' => 'Mwh', 'nilai' => []], 
                7 =>['bagian' => 'LAB', 'satuan' => 'Mwh', 'nilai' => []], 
                8 =>['bagian' => 'LPGP', 'satuan' => 'Mwh', 'nilai' => []], 
                9 =>['bagian' => 'AC', 'satuan' => 'Mwh', 'nilai' => []], 
                10 =>['bagian' => 'RC', 'satuan' => 'Mwh', 'nilai' => []], 
                11 =>['bagian' => 'HYDRANT', 'satuan' => 'Mwh', 'nilai' => []], 
                12 =>['bagian' => 'Chiller', 'satuan' => 'Mwh', 'nilai' => []], 
                13 =>['bagian' => 'Compressor', 'satuan' => 'Mwh', 'nilai' => []], 
                14 =>['bagian' => 'Cooling Tower', 'satuan' => 'Mwh', 'nilai' => []], 
                15 =>['bagian' => 'RUBY', 'satuan' => 'Mwh', 'nilai' => []], 
                16 =>['bagian' => 'UPS RUBY', 'satuan' => 'Mwh', 'nilai' => []], 
                17 =>['bagian' => 'GREEK', 'satuan' => 'Mwh', 'nilai' => []], 
                18 =>['bagian' => 'BAKERY', 'satuan' => 'Mwh', 'nilai' => []], 
                19 =>['bagian' => 'OFFICE-RD', 'satuan' => 'Mwh', 'nilai' => []], 
                20 =>['bagian' => 'AC GUDANG', 'satuan' => 'Mwh', 'nilai' => []], 
                21 =>['bagian' => 'RC', 'satuan' => 'Mwh', 'nilai' => []], 
                22 =>['bagian' => 'Chiller', 'satuan' => 'Mwh', 'nilai' => []], 
                23 =>['bagian' => 'Compressor', 'satuan' => 'Mwh', 'nilai' => []], 
                24 =>['bagian' => 'Colling Tower', 'satuan' => 'Mwh', 'nilai' => []], 
                25 =>['bagian' => 'Chiller', 'satuan' => 'Mwh', 'nilai' => []], 
                26 =>['bagian' => 'Compressor', 'satuan' => 'Mwh', 'nilai' => []], 
                27 =>['bagian' => 'Colling Tower', 'satuan' => 'Mwh', 'nilai' => []], 
            ];
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
                array_push($bagian[0]['nilai'], ['bagian' => 'PLN', 'nilai' => $a * 3.2, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[1]['nilai'], ['bagian' => 'LWBP', 'nilai' => $lbwp, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[2]['nilai'], ['bagian' => 'WBP', 'nilai' => $wbp,'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[3]['nilai'], ['bagian' => 'UPS Charging', 'nilai' => $ups, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[4]['nilai'], ['bagian' => 'NFI TOTAl', 'nilai' => $nfiTotal, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[5]['nilai'], ['bagian' => 'FRC', 'nilai' => $frc, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[6]['nilai'], ['bagian' => 'UPS FRC', 'nilai' => ($frc/$fr)* $ups, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[7]['nilai'], ['bagian' => 'LAB', 'nilai' => $lab, 'tanggal_penggunaan' => $tgl]); 
                // 'WTP & WWTP'
                array_push($bagian[8]['nilai'], ['bagian' => 'LPGP', 'nilai' => $lpgp, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[9]['nilai'], ['bagian' => 'AC', 'nilai' => $ac1 - $ac2, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[10]['nilai'],  ['bagian' => 'RC', 'nilai' => $rc1, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[11]['nilai'], ['bagian' => 'HYDRANT', 'nilai' => $hydrant, 'tanggal_penggunaan' => $tgl]); 
                // 'DEEPWELL' => penggunaan::where
                // 'UTILITY TOTAL'
                // 'Boiler'
                array_push($bagian[12]['nilai'],  ['bagian' => 'Chiller', 'nilai' => $chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[13]['nilai'], ['bagian' => 'Compressor', 'nilai' => $compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor), 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[14]['nilai'], ['bagian' => 'Cooling Tower', 'nilai' => $coolingTower, 'tanggal_penggunaan' => $tgl]); 
                // 'HNI TOTAL'x
                // 'PRODUKSI'
                array_push($bagian[15]['nilai'], ['bagian' => 'RUBY', 'nilai' => $ruby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[16]['nilai'], ['bagian' => 'UPS RUBY', 'nilai' => ($ruby / $fr) * $ups, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[17]['nilai'], ['bagian' => 'GREEK', 'nilai' => $greek, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[18]['nilai'], ['bagian' => 'BAKERY', 'nilai' => $bakery, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[19]['nilai'], ['bagian' => 'OFFICE-RD', 'nilai' => $officeRd, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[20]['nilai'], ['bagian' => 'AC GUDANG', 'nilai' => $acGudang, 'tanggal_penggunaan' => $tgl]); 
                // 'WTP & WWTP'
                // 'RUBY'
                // 'GREEK'
                // 'Non-Produksi'
                array_push($bagian[21]['nilai'], ['bagian' => 'RC', 'nilai' => $rc, 'tanggal_penggunaan' => $tgl]); 
                // 'DEEPWELL'
                // 'UTILITY'
                // 'RUBY Utility'
                // 'Boiler' => ($ruby/$rgf) * $chiller,
                array_push($bagian[22]['nilai'], ['bagian' => 'Chiller', 'nilai' => ($ruby/$rgf) * $chiller, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[23]['nilai'], ['bagian' => 'Compressor', 'nilai' => ($ruby/$rgf) * $compressor, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[24]['nilai'], ['bagian' => 'Colling Tower', 'nilai' => ($ruby/$rgf) * $coolingTower, 'tanggal_penggunaan' => $tgl]); 
                // 'GREEK  Utility'
                // 'Boiler'
    
                array_push($bagian[25]['nilai'], ['bagian' => 'Chiller', 'nilai' => ($greek/$rgf) * $chiller, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[26]['nilai'], ['bagian' => 'Compressor', 'nilai' => ($greek/$rgf) * $compressor, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[27]['nilai'], ['bagian' => 'Colling Tower', 'nilai' => ($greek/$rgf) * ($greek/$rgf) * $coolingTower, 'tanggal_penggunaan' => $tgl]); 
                
            }
        }
        else if($this->kategori == '3'){
            $bagian = [
                
                0 =>['bagian' => 'PGN MRS', 'satuan' => 'nm3', 'nilai' => []], 
                1 =>['bagian' => 'nm3', 'satuan' => 'mmbtu', 'nilai' => []], 
                2 =>['bagian' => 'MMBTU', 'satuan' => 'm3', 'nilai' => []], 
                3 =>['bagian' => 'PLANT SOLAR', 'satuan' => 'm3', 'nilai' => []], 
                4 =>['bagian' => 'GAS BOILER 10 TON', 'satuan' => 'nm3', 'nilai' => []], 
                5 =>['bagian' => 'GAS BOILER 5 TON', 'satuan' => 'nm3', 'nilai' => []], 
                6 =>['bagian' => 'NFI (GAS)', 'satuan' => '', 'nilai' => []], 
                7 =>['bagian' => 'NFI PRODUKSI (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                8 =>['bagian' => 'NFI PRODUKSI (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                9 =>['bagian' => 'NFI PRODUKSI (SOLAR)', 'satuan' => '', 'nilai' => []], 
                10 =>['bagian' => 'HNI (GAS)', 'satuan' => '', 'nilai' => []], 
                11 =>['bagian' => 'HNI RUBY (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                12 =>['bagian' => 'HNI GREEK (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                13 =>['bagian' => 'HNI RETORT (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                14 =>['bagian' => 'HNI RUBY (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                15 =>['bagian' => 'HNI GREEK (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                16 =>['bagian' => 'HNI RETORT (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                17 =>['bagian' => 'HNI PRODUKSI (SOLAR)', 'satuan' => 'nm3', 'nilai' => []], 
    
            ];
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
                
                // Array Push

                array_push($bagian[0]['nilai'], ['bagian' => 'PGN MRS', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[1]['nilai'], ['bagian' => 'nm3', 'nilai' => $nm3, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[2]['nilai'], ['bagian' => 'MMBTU', 'nilai' => $mmbtu, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[3]['nilai'], ['bagian' => 'PLANT SOLAR', 'nilai' => $plantSolar, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[4]['nilai'], ['bagian' => 'GAS BOILER 10 TON', 'nilai' => $gasBoiler10Ton, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[5]['nilai'], ['bagian' => 'GAS BOILER 5 TON', 'nilai' => $gasBoiler5Ton, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[6]['nilai'], ['bagian' => 'NFI (GAS)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[7]['nilai'], ['bagian' => 'NFI PRODUKSI (STEAM)', 'nilai' => $nfiProduksi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[8]['nilai'], ['bagian' => 'NFI PRODUKSI (GAS)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[9]['nilai'], ['bagian' => 'NFI PRODUKSI (SOLAR)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[10]['nilai'], ['bagian' => 'HNI (GAS)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[11]['nilai'], ['bagian' => 'HNI RUBY (STEAM)', 'nilai' => $hniRubySteam, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[12]['nilai'], ['bagian' => 'HNI GREEK (STEAM)', 'nilai' => $hniGreekGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[13]['nilai'], ['bagian' => 'HNI RETORT (STEAM)', 'nilai' => $hniRetortGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[14]['nilai'], ['bagian' => 'HNI RUBY (GAS)', 'nilai' => $hniRuby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[15]['nilai'], ['bagian' => 'HNI GREEK (GAS)', 'nilai' => $hniGreekGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[16]['nilai'], ['bagian' => 'HNI RETORT (GAS)', 'nilai' => $hniRetortGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[17]['nilai'], ['bagian' => 'HNI PRODUKSI (SOLAR)', 'nilai' => $hniProduksiSolar, 'tanggal_penggunaan' => $tgl]); 
            }
        }else{
            $bagian = [
                0 =>['bagian' => 'PLN', 'satuan' => 'Mwh', 'nilai' => []], 
                1 =>['bagian' => 'LWBP', 'satuan' => 'Mwh', 'nilai' => []], 
                2 =>['bagian' => 'WBP', 'satuan' => 'Mwh', 'nilai' => []], 
                3 =>['bagian' => 'UPS Charging', 'satuan' => 'Mwh', 'nilai' => []], 
                4 =>['bagian' => 'NFI TOTAl', 'satuan' => 'Mwh', 'nilai' => []], 
                5 =>['bagian' => 'FRC', 'satuan' => 'Mwh', 'nilai' => []], 
                6 =>['bagian' => 'UPS FRC', 'satuan' => 'Mwh', 'nilai' => []], 
                7 =>['bagian' => 'LAB', 'satuan' => 'Mwh', 'nilai' => []], 
                8 =>['bagian' => 'LPGP', 'satuan' => 'Mwh', 'nilai' => []], 
                9 =>['bagian' => 'AC', 'satuan' => 'Mwh', 'nilai' => []], 
                10 =>['bagian' => 'RC', 'satuan' => 'Mwh', 'nilai' => []], 
                11 =>['bagian' => 'HYDRANT', 'satuan' => 'Mwh', 'nilai' => []], 
                12 =>['bagian' => 'Chiller', 'satuan' => 'Mwh', 'nilai' => []], 
                13 =>['bagian' => 'Compressor', 'satuan' => 'Mwh', 'nilai' => []], 
                14 =>['bagian' => 'Cooling Tower', 'satuan' => 'Mwh', 'nilai' => []], 
                15 =>['bagian' => 'RUBY', 'satuan' => 'Mwh', 'nilai' => []], 
                16 =>['bagian' => 'UPS RUBY', 'satuan' => 'Mwh', 'nilai' => []], 
                17 =>['bagian' => 'GREEK', 'satuan' => 'Mwh', 'nilai' => []], 
                18 =>['bagian' => 'BAKERY', 'satuan' => 'Mwh', 'nilai' => []], 
                19 =>['bagian' => 'OFFICE-RD', 'satuan' => 'Mwh', 'nilai' => []], 
                20 =>['bagian' => 'AC GUDANG', 'satuan' => 'Mwh', 'nilai' => []], 
                21 =>['bagian' => 'RC', 'satuan' => 'Mwh', 'nilai' => []], 
                22 =>['bagian' => 'Chiller', 'satuan' => 'Mwh', 'nilai' => []], 
                23 =>['bagian' => 'Compressor', 'satuan' => 'Mwh', 'nilai' => []], 
                24 =>['bagian' => 'Colling Tower', 'satuan' => 'Mwh', 'nilai' => []], 
                25 =>['bagian' => 'Chiller', 'satuan' => 'Mwh', 'nilai' => []], 
                26 =>['bagian' => 'Compressor', 'satuan' => 'Mwh', 'nilai' => []], 
                27 =>['bagian' => 'Colling Tower', 'satuan' => 'Mwh', 'nilai' => []], 
                28 =>['bagian' => 'ESDM', 'satuan' => 'm3', 'nilai' => []], 
                29 =>['bagian' => 'Input Rain water WTP IE', 'satuan' => 'm3', 'nilai' => []], 
                30 =>['bagian' => 'Input Raw water WTP IE', 'satuan' => 'm3', 'nilai' => []], 
                31 =>['bagian' => 'Input process Demin', 'satuan' => 'm3', 'nilai' => []], 
                32 =>['bagian' => 'Input process Soft', 'satuan' => 'm3', 'nilai' => []], 
                33 =>['bagian' => 'Input Embung', 'satuan' => 'm3', 'nilai' => []], 
                34 =>['bagian' => 'Input Process Recycle', 'satuan' => 'm3', 'nilai' => []], 
                35 =>['bagian' => 'Permeate RO ', 'satuan' => 'm3', 'nilai' => []], 
                36 =>['bagian' => 'Reject Water', 'satuan' => 'm3', 'nilai' => []], 
                37 =>['bagian' => 'Waste WTP IE', 'satuan' => 'm3', 'nilai' => []], 
                38 =>['bagian' => 'Waste WTP Recycle', 'satuan' => 'm3', 'nilai' => []], 
                39 =>['bagian' => 'Waste Recycle Rate', 'satuan' => 'm3', 'nilai' => []], 
                40 =>['bagian' => 'Demin Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                41 =>['bagian' => 'Demin Water Boiler', 'satuan' => 'm3', 'nilai' => []], 
                42 =>['bagian' => 'Soft Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                43 =>['bagian' => 'Soft Water Non Produksi', 'satuan' => 'm3', 'nilai' => []], 
                44 =>['bagian' => 'Soft Water Lubrikasi', 'satuan' => 'm3', 'nilai' => []], 
                45 =>['bagian' => 'Soft Water Cooling Tower', 'satuan' => 'm3', 'nilai' => []], 
                46 =>['bagian' => 'Service Water', 'satuan' => 'm3', 'nilai' => []], 
                47 =>['bagian' => 'HNI', 'satuan' => 'm3', 'nilai' => []], 
                48 =>['bagian' => 'Demin Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                49 =>['bagian' => 'Demin Water Ruby', 'satuan' => 'm3', 'nilai' => []], 
                50 =>['bagian' => 'Demin Water Greek', 'satuan' => 'm3', 'nilai' => []], 
                51 =>['bagian' => 'Soft Water Produksi', 'satuan' => 'm3', 'nilai' => []], 
                52 =>['bagian' => 'Soft Water Ruby', 'satuan' => 'm3', 'nilai' => []], 
                53 =>['bagian' => 'Soft Water Greek', 'satuan' => 'm3', 'nilai' => []], 
                54 =>['bagian' => 'Demin Water Boiler', 'satuan' => 'm3', 'nilai' => []], 
                55 =>['bagian' => 'Boiler - Ruby', 'satuan' => 'm3', 'nilai' => []], 
                56 =>['bagian' => 'Boiler - Greek', 'satuan' => 'm3', 'nilai' => []], 
                57 =>['bagian' => 'Boiler - Retort', 'satuan' => 'm3', 'nilai' => []], 
                58 =>['bagian' => 'Soft Water Gedung Depan', 'satuan' => 'm3', 'nilai' => []], 
                59 =>['bagian' => 'Soft Water HB', 'satuan' => 'm3', 'nilai' => []], 
                60 =>['bagian' => 'Soft Water Bakery', 'satuan' => 'm3', 'nilai' => []], 
                61 =>['bagian' => 'PGN MRS', 'satuan' => 'nm3', 'nilai' => []], 
                62 =>['bagian' => 'nm3', 'satuan' => 'mmbtu', 'nilai' => []], 
                63 =>['bagian' => 'MMBTU', 'satuan' => 'm3', 'nilai' => []], 
                64 =>['bagian' => 'PLANT SOLAR', 'satuan' => 'm3', 'nilai' => []], 
                65 =>['bagian' => 'GAS BOILER 10 TON', 'satuan' => 'nm3', 'nilai' => []], 
                66 =>['bagian' => 'GAS BOILER 5 TON', 'satuan' => 'nm3', 'nilai' => []], 
                67 =>['bagian' => 'NFI (GAS)', 'satuan' => '', 'nilai' => []], 
                68 =>['bagian' => 'NFI PRODUKSI (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                69 =>['bagian' => 'NFI PRODUKSI (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                70 =>['bagian' => 'NFI PRODUKSI (SOLAR)', 'satuan' => '', 'nilai' => []], 
                71 =>['bagian' => 'HNI (GAS)', 'satuan' => '', 'nilai' => []], 
                72 =>['bagian' => 'HNI RUBY (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                73 =>['bagian' => 'HNI GREEK (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                74 =>['bagian' => 'HNI RETORT (STEAM)', 'satuan' => 'kg', 'nilai' => []], 
                75 =>['bagian' => 'HNI RUBY (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                76 =>['bagian' => 'HNI GREEK (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                77 =>['bagian' => 'HNI RETORT (GAS)', 'satuan' => 'nm3', 'nilai' => []], 
                78 =>['bagian' => 'HNI PRODUKSI (SOLAR)', 'satuan' => 'nm3', 'nilai' => []], 
    
            ];
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
                array_push($bagian[0]['nilai'], ['bagian' => 'PLN', 'nilai' => $a * 3.2, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[1]['nilai'], ['bagian' => 'LWBP', 'nilai' => $lbwp, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[2]['nilai'], ['bagian' => 'WBP', 'nilai' => $wbp,'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[3]['nilai'], ['bagian' => 'UPS Charging', 'nilai' => $ups, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[4]['nilai'], ['bagian' => 'NFI TOTAl', 'nilai' => $nfiTotal, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[5]['nilai'], ['bagian' => 'FRC', 'nilai' => $frc, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[6]['nilai'], ['bagian' => 'UPS FRC', 'nilai' => ($frc/$fr)* $ups, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[7]['nilai'], ['bagian' => 'LAB', 'nilai' => $lab, 'tanggal_penggunaan' => $tgl]); 
                // 'WTP & WWTP'
                array_push($bagian[8]['nilai'], ['bagian' => 'LPGP', 'nilai' => $lpgp, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[9]['nilai'], ['bagian' => 'AC', 'nilai' => $ac1 - $ac2, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[10]['nilai'],  ['bagian' => 'RC', 'nilai' => $rc1, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[11]['nilai'], ['bagian' => 'HYDRANT', 'nilai' => $hydrant, 'tanggal_penggunaan' => $tgl]); 
                // 'DEEPWELL' => penggunaan::where
                // 'UTILITY TOTAL'
                // 'Boiler'
                array_push($bagian[12]['nilai'],  ['bagian' => 'Chiller', 'nilai' => $chiller - (($ruby/$rgf) * $chiller) - ($greek/$rgf) * $chiller, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[13]['nilai'], ['bagian' => 'Compressor', 'nilai' => $compressor - (($ruby/$rgf) * $compressor) -  (($greek/$rgf) * $compressor), 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[14]['nilai'], ['bagian' => 'Cooling Tower', 'nilai' => $coolingTower, 'tanggal_penggunaan' => $tgl]); 
                // 'HNI TOTAL'x
                // 'PRODUKSI'
                array_push($bagian[15]['nilai'], ['bagian' => 'RUBY', 'nilai' => $ruby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[16]['nilai'], ['bagian' => 'UPS RUBY', 'nilai' => ($ruby / $fr) * $ups, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[17]['nilai'], ['bagian' => 'GREEK', 'nilai' => $greek, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[18]['nilai'], ['bagian' => 'BAKERY', 'nilai' => $bakery, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[19]['nilai'], ['bagian' => 'OFFICE-RD', 'nilai' => $officeRd, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[20]['nilai'], ['bagian' => 'AC GUDANG', 'nilai' => $acGudang, 'tanggal_penggunaan' => $tgl]); 
                // 'WTP & WWTP'
                // 'RUBY'
                // 'GREEK'
                // 'Non-Produksi'
                array_push($bagian[21]['nilai'], ['bagian' => 'RC', 'nilai' => $rc, 'tanggal_penggunaan' => $tgl]); 
                // 'DEEPWELL'
                // 'UTILITY'
                // 'RUBY Utility'
                // 'Boiler' => ($ruby/$rgf) * $chiller,
                array_push($bagian[22]['nilai'], ['bagian' => 'Chiller', 'nilai' => ($ruby/$rgf) * $chiller, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[23]['nilai'], ['bagian' => 'Compressor', 'nilai' => ($ruby/$rgf) * $compressor, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[24]['nilai'], ['bagian' => 'Colling Tower', 'nilai' => ($ruby/$rgf) * $coolingTower, 'tanggal_penggunaan' => $tgl]); 
                // 'GREEK  Utility'
                // 'Boiler'
    
                array_push($bagian[25]['nilai'], ['bagian' => 'Chiller', 'nilai' => ($greek/$rgf) * $chiller, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[26]['nilai'], ['bagian' => 'Compressor', 'nilai' => ($greek/$rgf) * $compressor, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[27]['nilai'], ['bagian' => 'Colling Tower', 'nilai' => ($greek/$rgf) * ($greek/$rgf) * $coolingTower, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[28]['nilai'], ['bagian' => 'ESDM', 'nilai' => $esdm, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[29]['nilai'], ['bagian' => 'Input Rain water WTP IE', 'nilai' => $inputRainWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[30]['nilai'], ['bagian' => 'Input Raw water WTP IE', 'nilai' => $inputRawWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[31]['nilai'], ['bagian' => 'Input process Demin', 'nilai' => $inputProcessDemin, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[32]['nilai'], ['bagian' => 'Input process Soft', 'nilai' => $inputProcessSoft, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[33]['nilai'], ['bagian' => 'Input Embung', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[34]['nilai'], ['bagian' => 'Input Process Recycle', 'nilai' => $inputProcessRecycle, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[35]['nilai'], ['bagian' => 'Permeate RO ', 'nilai' => $permeateRo, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[36]['nilai'], ['bagian' => 'Reject Water', 'nilai' => $rejectWater, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[37]['nilai'], ['bagian' => 'Waste WTP IE', 'nilai' => $wasteWtpIe, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[38]['nilai'], ['bagian' => 'Waste WTP Recycle', 'nilai' => $wasteWtpRecycle, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[39]['nilai'], ['bagian' => 'Waste Recycle Rate', 'nilai' => $waterRecycleRate, 'tanggal_penggunaan' => $tgl]); 
                // NFI
                array_push($bagian[40]['nilai'], ['bagian' => 'Demin Water Produksi', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[41]['nilai'], ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[42]['nilai'], ['bagian' => 'Soft Water Produksi', 'nilai' => $softWaterProduksi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[43]['nilai'], ['bagian' => 'Soft Water Non Produksi', 'nilai' => $softWaterNonProduksi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[44]['nilai'], ['bagian' => 'Soft Water Lubrikasi', 'nilai' => $softWaterLubrikasi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[45]['nilai'], ['bagian' => 'Soft Water Cooling Tower', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[46]['nilai'], ['bagian' => 'Service Water', 'nilai' => $serviceWater, 'tanggal_penggunaan' => $tgl]); 
                // // HNI
                array_push($bagian[47]['nilai'], ['bagian' => 'HNI', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[48]['nilai'], ['bagian' => 'Demin Water Produksi', 'nilai' => $deminWaterProdukHb, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[49]['nilai'], ['bagian' => 'Demin Water Ruby', 'nilai' => $deminWaterRuby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[50]['nilai'], ['bagian' => 'Demin Water Greek', 'nilai' => $deminWaterGreek, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[51]['nilai'], ['bagian' => 'Soft Water Produksi', 'nilai' => $deminWaterProdukHb, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[52]['nilai'], ['bagian' => 'Soft Water Ruby', 'nilai' => $softWaterRuby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[53]['nilai'], ['bagian' => 'Soft Water Greek', 'nilai' => $softWaterGreek, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[54]['nilai'], ['bagian' => 'Demin Water Boiler', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[55]['nilai'], ['bagian' => 'Boiler - Ruby', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[56]['nilai'], ['bagian' => 'Boiler - Greek', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[57]['nilai'], ['bagian' => 'Boiler - Retort', 'nilai' => $inputEmbung, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[58]['nilai'], ['bagian' => 'Soft Water Gedung Depan', 'nilai' => $softWaterGedungDepan, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[59]['nilai'], ['bagian' => 'Soft Water HB', 'nilai' => $softWaterHb, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[60]['nilai'], ['bagian' => 'Soft Water Bakery', 'nilai' => $softWaterBakery, 'tanggal_penggunaan' => $tgl]); 
                // otw
                array_push($bagian[61]['nilai'], ['bagian' => 'PGN MRS', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[62]['nilai'], ['bagian' => 'nm3', 'nilai' => $nm3, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[63]['nilai'], ['bagian' => 'MMBTU', 'nilai' => $mmbtu, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[64]['nilai'], ['bagian' => 'PLANT SOLAR', 'nilai' => $plantSolar, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[65]['nilai'], ['bagian' => 'GAS BOILER 10 TON', 'nilai' => $gasBoiler10Ton, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[66]['nilai'], ['bagian' => 'GAS BOILER 5 TON', 'nilai' => $gasBoiler5Ton, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[67]['nilai'], ['bagian' => 'NFI (GAS)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[68]['nilai'], ['bagian' => 'NFI PRODUKSI (STEAM)', 'nilai' => $nfiProduksi, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[69]['nilai'], ['bagian' => 'NFI PRODUKSI (GAS)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[70]['nilai'], ['bagian' => 'NFI PRODUKSI (SOLAR)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[71]['nilai'], ['bagian' => 'HNI (GAS)', 'nilai' => "Belum", 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[72]['nilai'], ['bagian' => 'HNI RUBY (STEAM)', 'nilai' => $hniRubySteam, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[73]['nilai'], ['bagian' => 'HNI GREEK (STEAM)', 'nilai' => $hniGreekGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[74]['nilai'], ['bagian' => 'HNI RETORT (STEAM)', 'nilai' => $hniRetortGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[75]['nilai'], ['bagian' => 'HNI RUBY (GAS)', 'nilai' => $hniRuby, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[76]['nilai'], ['bagian' => 'HNI GREEK (GAS)', 'nilai' => $hniGreekGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[77]['nilai'], ['bagian' => 'HNI RETORT (GAS)', 'nilai' => $hniRetortGas, 'tanggal_penggunaan' => $tgl]); 
                array_push($bagian[78]['nilai'], ['bagian' => 'HNI PRODUKSI (SOLAR)', 'nilai' => $hniProduksiSolar, 'tanggal_penggunaan' => $tgl]); 
            }
        }
        return view('utilityOnline.admin.export.penggunaanReport3',['bagian' => $bagian , 'tgl' => $cek, 'jmlTgl' => $no]);
    }
}
