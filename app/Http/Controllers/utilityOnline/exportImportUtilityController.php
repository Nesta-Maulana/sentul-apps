<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\pengamatan;
use App\exports\utilityOnline\pengamatanExport;
use DB;
use Excel;

class exportImportUtilityController extends Controller
{  
    public function export(){
        return (new pengamatanExport('2019-04-24', '2019-04-24'))->download('cek.xlsx');
    }
}
