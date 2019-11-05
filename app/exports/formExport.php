<?php

namespace App\Exports;

use App\Models\masterApps\formHead;
use Maatwebsite\Excel\Concerns\FromCollection;

class formExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return formHead::all();
    }
}
