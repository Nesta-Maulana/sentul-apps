<?php

namespace App\exports\utilityOnline;

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
                    $dates = Carbon::createFromDate($time[0], $time[1], $time[2], $tz)->addDay('1');
                    $dates = explode(' ', $dates);
                    $date1 = $dates[0];
                    $penggunaanBagian = penggunaan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $date1 . ' 05:59:59'])->first();
                }else{
                    $penggunaanBagian = penggunaan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $tgl[$i] . ' 05:59:59'])->first();
                }
                $output = [$penggunaanBagian];
                array_push($penggunaan, $output);
            }
            $b->penggunaan = $penggunaan;
        }
        return view('utilityOnline.admin.export.penggunaanReport',['bagian' => $bagian , 'tgl' => $tgl, 'jmlTgl' => $this->jmlDate]);

        // if($this->tgl1 == null && $this->tgl2 == null){
        //     $penggunaan = penggunaan::all();
        // } else if($this->tgl1 == $this->tgl2){
        //     $penggunaan =  penggunaan::query()->whereDate('created_at', $this->tgl2)->get();
        // }else{
        //     $penggunaan =  penggunaan::query()->whereBetween('created_at', [$this->tgl1,$this->tgl2])->get();
        // }
        // return view('utilityOnline.admin.export.penggunaanReport',['penggunaan' => $penggunaan ]);
    }
}
