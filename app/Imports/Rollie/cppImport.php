<?php

namespace App\Imports\Rollie;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Rollie\Cpp;
use App\Models\Rollie\Lot;
use App\Models\Rollie\Wo;
class cppImport implements ToCollection
{
    public function collection(Collection $collection)
    {

    }
} 
