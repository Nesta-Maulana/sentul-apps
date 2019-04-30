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

class pengamatanExport implements FromView, WithHeadings, ShouldAutoSize
{

    use Exportable;

    public function __construct(string $tgl1, string $tgl2, string $nama_report, string $from){
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
        $this->nama_report = $nama_report;
        $this->from = $from;
    }
    public function headings(): array
    {

    }
    public function view(): View
    {
        if($this->tgl1 == null && $this->tgl2 == null){
            $pengamatan = pengamatan::all();
        } else if($this->tgl1 == $this->tgl2){
            $pengamatan =  pengamatan::query()->whereDate('created_at', $this->tgl2)->get();
        }else{
            $pengamatan =  pengamatan::query()->whereBetween('created_at', [$this->tgl1,$this->tgl2])->get();
        }
        return view('utilityOnline.admin.export.pengamatanReport',['pengamatan' => $pengamatan ]);
    }

}
?>