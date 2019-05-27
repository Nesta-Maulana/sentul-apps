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

class report4Export implements FromView, WithHeadings, ShouldAutoSize
{
    use Exportable; 

    public function __construct(string $from, string $to, string $kategori){
        $this->from = $from;
        $this->to = $to;
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

        if($this->from == "" && $this->to == ""){
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
            
        }else{
            $from1 = $this->from;
            $to1 = $this->to;
            $tz = 'Asia/Jakarta';
            $from1 = explode('-', $from1);
            $to1 = explode('-', $to1);        
            $from1 = Carbon::createFromDate($from1[0], $from1[1], $from1[2], $tz);        
            $to1 = Carbon::createFromDate($to1[0], $to1[1], $to1[2], $tz);
            $cek = $this->generateDateRange($from1, $to1);  
            
        }

        if($this->kategori == ""){
            $bagian = [
                0 => ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => []],
                1 => ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => []],
                2 => ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => []],
                3 => ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => []],
                4 => ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => []],
                5 => ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => []],
                6 => ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => []],
                7 => ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                8 => ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                9 => ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                10 =>[ 'bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => []],
            ];
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
                array_push($bagian[0]['nilai'], ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian[1]['nilai'], ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => $nfiFixLoadWater, 'tgl_penggunaan' => $tgl]);
                array_push($bagian[2]['nilai'], ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[3]['nilai'], ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[4]['nilai'], ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[5]['nilai'], ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                array_push($bagian[6]['nilai'], ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                // Listrik
                array_push($bagian[7]['nilai'], ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian[8]['nilai'], ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian[9]['nilai'], ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                array_push($bagian[10]['nilai'], ['bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
                
            }
        }
        
        else{
            if($this->kategori == '1'){
                $bagian = [
                    0 => ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => []],
                    1 => ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => []],
                    2 => ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => []],
                    3 => ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => []],
                    4 => ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => []],
                    5 => ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => []],
                    6 => ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => []]
                ];
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
                    array_push($bagian[0]['nilai'], ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $nfiVarLoadWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[1]['nilai'], ['bagian' => 'NFI FIX LOAD', 'satuan' => 'm3', 'nilai' => $nfiFixLoadWater, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[2]['nilai'], ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => $hniVarloadWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian[3]['nilai'], ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => $rubyWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian[4]['nilai'], ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => $greekWater, 'tgl_penggunaan' => $tgl]);
                        array_push($bagian[5]['nilai'], ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => $softWaterBakery, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[6]['nilai'], ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => $softWaterHb, 'tgl_penggunaan' => $tgl]);
                }
            }
            else if($this->kategori == '2'){
                $bagian = [
                    0 => ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    1 => ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    2 => ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    3 => ['bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                ];
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
                    array_push($bagian[0]['nilai'], ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[1]['nilai'], ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $nfiFixLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[2]['nilai'], ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => $hniVarLoad, 'tgl_penggunaan' => $tgl]);
                    array_push($bagian[3]['nilai'], ['bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => $hniFixLoad, 'tgl_penggunaan' => $tgl]);
                }
            }
            else if($this->kategori == '3'){
                foreach ($cek as $tgl ) {
                    
                }
            }
        }
        
        return view('utilityOnline.admin.export.penggunaanReport4', ['bagian' => $bagian, 'tgl' => $cek, 'jmlTgl' => count($cek)]);
    }
}
