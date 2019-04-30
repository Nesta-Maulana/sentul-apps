<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\pengamatan;
use App\exports\utilityOnline\pengamatanExport;
use App\exports\utilityOnline\penggunaanExport;
use App\Models\utilityOnline\bagian;
use DB;
use Excel;

class exportImportUtilityController extends Controller
{  
    public function exportPengamatan($nama_report, $from,$tgl1, $tgl2){
        return Excel::download(new pengamatanExport($tgl1, $tgl2, $nama_report, $from), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');
    }
    public function exportPengamatan2($nama_report, $from){
        return Excel::download(new pengamatanExport('', '', $nama_report, $from), $nama_report . $from . '.xlsx');
    }
    public function exportPenggunaan($nama_report, $from,$tgl1, $tgl2){
        return Excel::download(new penggunaanExport($tgl1, $tgl2),$nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx' );
    }
}
