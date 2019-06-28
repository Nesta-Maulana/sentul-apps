<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Penyelia\mtolImport;
class mtolUpload implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            
            // Select by sheet name
            'Mampu Telusur Produk Online (MT' => new mtolImport,
        ];
    }


}
