<?php 
namespace App\exports\utilityOnline;

use App\Models\utilityOnline\pengamatan;
use App\Models\utilityOnline\bagian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class pengamatanExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $tgl1, string $tgl2){
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
    }
    public function headings(): array
    {
        return [
            '#',
            'Bagian',
            'Nilai',
            'Nama',
            'user_update',
            'Created At',
            'Last Update'
        ];
    }
    public function query()
    {
        $date = \Carbon\Carbon::yesterday();
        $pengamatan  = pengamatan::all();
        // $pengamatan =  pengamatan::whereBetween('created_at', [$date->toDateString() . ' 00:00:00',$date->toDateString() . ' 00:00:00'])->get();
        // dd($pengamatan);
        foreach ($pengamatan as $p ) {
            $p->id_bagian = $p->bagian->bagian;
            $p->user_id = $p->user->karyawan->fullname;
        }
        return $pengamatan;
    }

}
?>