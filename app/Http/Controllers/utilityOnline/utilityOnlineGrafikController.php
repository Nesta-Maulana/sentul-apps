<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\penggunaan;
use \Carbon\Carbon;
use DB;
use Session;

class utilityOnlineGrafikController extends resourceController
{
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
        }
        
        return $bagians;

        
    }
}
