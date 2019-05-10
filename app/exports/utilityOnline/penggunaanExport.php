<?php

namespace App\exports\utilityOnline;

use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use \Carbon\Carbon;


class penggunaanExport implements FromView, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $tgl1, string $tgl2){
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
        $this->from = explode('-', $tgl1);
        $this->to = explode('-', $tgl2); 
        $this->to = Carbon::createFromDate($this->to[0], $this->to[1], $this->to[2]);
        $this->from = Carbon::createFromDate($this->from[0], $this->from[1], $this->from[2]);
    }
    public function headings(): array
    {

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
    public function view(): View
    {
        $tz = 'Asia/Jakarta';
        $tgl = $this->generateDateRange($this->from, $this->to);
        $bagian = bagian::all();
        foreach ($bagian as $b) 
        {  
            $i = 0;
            $penggunaan = [];
            foreach ($tgl as $c ) {
                $i++;
                if($i == $this->jmlDate){
                    $time = explode('-', $c);
                    $dates = Carbon::createFromDate($time[0], $time[1], $time[2], $tz);
                    $dates = explode(' ', $dates);
                    $date1 = $dates[0];
                    $penggunaanBagian = penggunaan::where('id_bagian', $b->id)->whereBetween('tgl_penggunaan', [$c, $date1])->first();
                    if(!$penggunaanBagian){
                        $penggunaanBagian = penggunaan::where('id_bagian', $b->id)->latest()->first();
                        $penggunaanBagian->nilai_nfi = '0';
                        $penggunaanBagian->nilai_hni = '0';   
                    }else{
                        $rasioHead = rasioHead::where('bagian_id', $penggunaanBagian->id_bagian)->latest()->first();
                        if($rasioHead){
                            $nilai = [];
                            $i = 0;
                            foreach ($rasioHead->rasioDetail as $rd) {
                                array_push($nilai, $rd);
                                $i++;
                            }
                            if($i == 1){
                                if($nilai[0]->company_id != '1'){
                                    if( $penggunaanBagian->nilai == '0' ){ 
                                        $penggunaanBagian->nilai_nfi = '0';
                                        $penggunaanBagian->nilai_hni = '0';
                                    }
                                    else{

                                        $penggunaanBagian->nilai_hni = '0';
                                        $penggunaanBagian->nilai_nfi = $nilai[0]->nilai / $penggunaanBagian->nilai * 100;
                                    }
                                }else{
                                    if( $penggunaanBagian->nilai == '0' ){ 
                                        $penggunaanBagian->nilai_nfi = '0';
                                        $penggunaanBagian->nilai_hni = '0';
                                    }
                                    else{
                                        $penggunaanBagian->nilai_nfi = '0';
                                        $penggunaanBagian->nilai_hni = $nilai[0]->nilai / $penggunaanBagian->nilai * 100;
                                    }
                                }
                            }else if($i < 1){
                                $penggunaanBagian->nilai_nfi = '0';
                                $penggunaanBagian->nilai_hni = '0';    
                            }else{
                                if( $penggunaanBagian->nilai == '0' ){ 
                                    $penggunaanBagian->nilai_nfi = '0';
                                    $penggunaanBagian->nilai_hni = '0';
                                }
                                else{
                                    $penggunaanBagian->nilai_nfi = $nilai[0]->nilai / $penggunaanBagian->nilai * 100;
                                    $penggunaanBagian->nilai_hni = $nilai[1]->nilai / $penggunaanBagian->nilai * 100;
                                }
                            }
                            
                        }else{
                            $penggunaanBagian->nilai_nfi = '0';
                            $penggunaanBagian->nilai_hni = '0';    
                        }
                    }
                }else{
                    $penggunaanBagian = penggunaan::where('id_bagian', $b->id)->whereBetween('tgl_penggunaan', [$c, $tgl[$i]])->first();
                    if(!$penggunaanBagian){
                        $penggunaanBagian = penggunaan::where('id_bagian', $b->id)->latest()->first();
                        $penggunaanBagian->nilai_nfi = '0';
                        $penggunaanBagian->nilai_hni = '0';   
                    }else{
                        $rasioHead = rasioHead::where('bagian_id', $penggunaanBagian->id_bagian)->latest()->first();
                        if($rasioHead){
                            $nilai = [];
                            $i = 0;
                            foreach ($rasioHead->rasioDetail as $rd) {
                                array_push($nilai, $rd);
                                $i++;
                            }
                            if($i == 1){
                                if($nilai[0]->company_id != '1'){
                                    if( $penggunaanBagian->nilai == '0' ){ 
                                        $penggunaanBagian->nilai_nfi = '0';
                                        $penggunaanBagian->nilai_hni = '0';
                                    }
                                    else{
                                        
                                        $penggunaanBagian->nilai_hni = '0';
                                        $penggunaanBagian->nilai_nfi = $nilai[0]->nilai / $penggunaanBagian->nilai * 100;
                                    }
                                }else{
                                    if( $penggunaanBagian->nilai == '0' ){ 
                                        $penggunaanBagian->nilai_nfi = '0';
                                        $penggunaanBagian->nilai_hni = '0';
                                    }
                                    else{
                                        $penggunaanBagian->nilai_nfi = '0';
                                        $penggunaanBagian->nilai_hni = $nilai[0]->nilai / $penggunaanBagian->nilai * 100;
                                    }
                                }
                            }else if($i < 1){
                                $penggunaanBagian->nilai_nfi = '0';
                                $penggunaanBagian->nilai_hni = '0';    
                            }else{
                                if( $penggunaanBagian->nilai == '0' ){ 
                                    $penggunaanBagian->nilai_nfi = '0';
                                    $penggunaanBagian->nilai_hni = '0';
                                }
                                else{
                                    $penggunaanBagian->nilai_nfi = $nilai[0]->nilai / $penggunaanBagian->nilai * 100;
                                    $penggunaanBagian->nilai_hni = $nilai[1]->nilai / $penggunaanBagian->nilai * 100;
                                }
                            }
                            
                        }else{
                            $penggunaanBagian->nilai_nfi = '0';
                            $penggunaanBagian->nilai_hni = '0';    
                        }
                    }
                }
                $output = [$penggunaanBagian];
                array_push($penggunaan, $output);
            }
            $b->penggunaan = $penggunaan;
        }
        // dd($bagian[35]);
        return view('utilityOnline.admin.export.penggunaanReport',['bagian' => $bagian , 'tgl' => $tgl, 'jmlTgl' => $this->jmlDate]);
    }
}
