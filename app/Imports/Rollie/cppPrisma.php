<?php

namespace App\Imports\Rollie;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class cppPrisma implements WithMultipleSheets
{
    public function sheets(): array
    { 
        return [
            'db2' => new cppImport,
        ];
    }
}
