<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\pengamatan;
use App\exports\utilityOnline\pengamatanExport;
use App\exports\utilityOnline\penggunaanExport;
use App\exports\utilityOnline\report3Export;
use App\exports\utilityOnline\report4Export;
use App\exports\utilityOnline\report5Export;
use App\Models\utilityOnline\bagian;
use DB;
use Excel;

class exportImportUtilityController extends Controller
{  
    public function exportPengamatan($nama_report, $from,$tgl1, $tgl2)
    {
        if($nama_report == 'pengamatan')
        {
            return Excel::download(new pengamatanExport($tgl1, $tgl2, $nama_report, $from), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');
        }
        else if($nama_report == 'penggunaan'){
            $kategori = "";
            return Excel::download(new penggunaanExport($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');
        }
        else{

        }
    }
    public function penggunaanKategori($nama_report, $from, $kategori){
        $tgl1 = "";
        $tgl2 = "";
        return Excel::download(new penggunaanExport($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');
    }
    public function penggunaanKategoriTgl($nama_report, $from, $kategori, $tgl1, $tgl2){
        return Excel::download(new penggunaanExport($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');
    }
    public function report3Tgl($nama_report, $from, $tgl1, $tgl2){
        $kategori = "";
        return Excel::download(new report3Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function report3Kategori($nama_report, $from, $kategori){
        $tgl1 = "";
        $tgl2 = "";
        return Excel::download(new report3Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function report3KategoriTgl($nama_report, $from, $tgl1, $tgl2, $kategori){
        return Excel::download(new report3Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function exportReport4Kategori($nama_report, $from, $kategori){
        $tgl1 = "";
        $tgl2 = "";
        return Excel::download(new report4Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function exportReport4Tgl($nama_report, $from, $tgl1, $tgl2){
        $kategori = "";
        return Excel::download(new report4Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function exportReport4TglKategori($nama_report, $from, $tgl1, $tgl2, $kategori){
        return Excel::download(new report4Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function exportReport5Tgl($nama_report, $from, $tgl1, $tgl2){
        $kategori = "";
        return Excel::download(new report5Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
    public function exportReport5TglKategori($nama_report, $from, $tgl1, $tgl2, $kategori){
        return Excel::download(new report5Export($tgl1, $tgl2, $kategori), $nama_report . $from . $tgl1 . '-' . $tgl2 . '.xlsx');   
    }
}
