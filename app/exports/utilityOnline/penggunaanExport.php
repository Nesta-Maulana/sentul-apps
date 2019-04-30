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


class penggunaanExport implements FromView, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $tgl1, string $tgl2){
        $this->tgl1 = $tgl1;
        $this->tgl2 = $tgl2;
    }
    public function headings(): array
    {

    }
    public function view(): View
    {
        if($this->tgl1 == null && $this->tgl2 == null){
            $penggunaan = penggunaan::all();
        } else if($this->tgl1 == $this->tgl2){
            $penggunaan =  penggunaan::query()->whereDate('created_at', $this->tgl2)->get();
        }else{
            $penggunaan =  penggunaan::query()->whereBetween('created_at', [$this->tgl1,$this->tgl2])->get();
        }
        return view('utilityOnline.admin.export.penggunaanReport',['penggunaan' => $penggunaan ]);
    }
}
