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

class report5Export implements FromView, WithHeadings, ShouldAutoSize
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
            $bagian = [];
            
            
            foreach ($cek as $tgl ) {

            }
        }
        else{
            if($this->kategori == '1'){
                $bagian = [
                    0=> ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'm3', 'nilai' => []],
                    1=> ['bagian' => 'NFI FIX. LOAD', 'satuan' => 'm3', 'nilai' => []],
                    2=> ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => []],
                    3=> ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => []],
                    4=> ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'm3', 'nilai' => []],
                    5=> ['bagian' => 'Ruby', 'satuan' => 'm3', 'nilai' => []],
                    6=> ['bagian' => 'Greek', 'satuan' => 'm3', 'nilai' => []],
                    7=> ['bagian' => 'Bakery', 'satuan' => 'm3', 'nilai' => []],
                    8=> ['bagian' => 'HNI FIX LOAD', 'satuan' => 'm3', 'nilai' => []],
                    9=> ['bagian' => 'HNI % Variable Load', 'satuan' => '%', 'nilai' => []],
                    10=> ['bagian' => 'HNI % Fix Load', 'satuan' => '%', 'nilai' => []],
                ];
                foreach ($cek as $tgl ) {
                }
            }
            else if($this->kategori == '2'){
                $bagian = [
                    0=> ['bagian' => 'NFI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    1=> ['bagian' => 'NFI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    2=> ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => []],
                    3=> ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => []],
                    4=> ['bagian' => 'HNI VAR. LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    5 =>[ 'bagian' => 'HNI FIX LOAD', 'satuan' => 'Mwh', 'nilai' => []],
                    6 =>[ 'bagian' => 'Ruby', 'satuan' => 'Mwh', 'nilai' => []],
                    7 =>[ 'bagian' => 'Greek', 'satuan' => 'Mwh', 'nilai' => []],
                    8 =>[ 'bagian' => 'Bakery', 'satuan' => 'Mwh', 'nilai' => []],
                    9=> ['bagian' => 'NFI % Variable Load', 'satuan' => '%', 'nilai' => []],
                    10=> ['bagian' => 'NFI % Fix Load', 'satuan' => '%', 'nilai' => []],
                ];
            }
            else if($this->kategori == '3'){
                foreach ($cek as $tgl ) {
                    
                }
            }
        } 
        return view('utilityOnline.admin.export.penggunaanReport4', ['bagian' => $bagian, 'tgl' => $cek, 'jmlTgl' => count($cek)]);
    }
}
