<?php 
namespace App\exports\utilityOnline;

use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\bagian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use \Carbon\Carbon;

class pengamatanExport implements FromView, WithHeadings, ShouldAutoSize
{

    use Exportable;

    public function __construct(string $tgl1, string $tgl2, string $nama_report, string $from){
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
        $this->from = explode('-', $tgl1);
        $this->to = explode('-', $tgl2); 
        $this->to_tgl = Carbon::createFromDate($this->to[0], $this->to[1], $this->to[2]);
        $this->from_tgl = Carbon::createFromDate($this->from[0], $this->from[1], $this->from[2]);
        $this->nama_report = $nama_report;
        $this->from = $from;
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
    public function headings(): array
    {

    }
    public function view(): View
    {
        $tz = 'Asia/Jakarta';
        $tgl = $this->generateDateRange($this->from_tgl, $this->to_tgl);
        $this->tgl2 = explode('-', $this->tgl2);
        $this->tgl2 = Carbon::createFromDate($this->tgl2[0], $this->tgl2[1], $this->tgl2[2], 'Asia/Jakarta')->addDay('1');
        $this->tgl2 = explode(' ', $this->tgl2);
        $this->tgl2 = $this->tgl2[0];
        $bagian = bagian::all();
        foreach ($bagian as $b) 
        {  
            $i = 0;
            $pengamatan = [];
            foreach ($tgl as $c ) {
                $i++;
                if($i == $this->jmlDate){
                    $time = explode('-', $c);
                    $dates = Carbon::createFromDate($time[0], $time[1], $time[2], $tz)->addDay('1');
                    $dates = explode(' ', $dates);
                    $date1 = $dates[0];
                    $pengamatanBagian = pengamatan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $date1 . ' 05:59:59'])->first();
                }else{
                    $pengamatanBagian = pengamatan::where('id_bagian', $b->id)->whereBetween('created_at', [$c . ' 06:00:00', $tgl[$i] . ' 05:59:59'])->first();
                }
                $output = [$pengamatanBagian];
                array_push($pengamatan, $output);
            }
            $b->pengamatan = $pengamatan;
        }
        // if($this->tgl1 == null && $this->tgl2 == null){
        //     $pengamatan = pengamatan::all();
        // } else if($this->tgl1 == $this->tgl2){
        //     $pengamatan =  pengamatan::query()->whereBetween('created_at', [$this->tgl1 . ' 06:00:00', $this->tgl2. ' 05:59:59'])->get();
        // }else{
        //     $pengamatan =  pengamatan::query()->whereBetween('created_at', [$this->tgl1 . ' 06:00:00',$this->tgl2 . ' 05:59:59'])->get();
        // }
        return view('utilityOnline.admin.export.pengamatanReport',['pengamatan' => $pengamatan, 'bagian' => $bagian , 'tgl' => $tgl, 'jmlTgl' => $this->jmlDate]);
    }

}
?>