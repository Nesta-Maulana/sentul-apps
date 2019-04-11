<?php

namespace App\Imports\Rollie;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class cppBrix implements WithMultipleSheets
{
    public function sheets(): array
    { 
        return [
            'db1' => new cppImport,
        ];
    }
} 
 