<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Http\Controllers\Controller;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\produk;
use App\Models\masterApps\brand;
use App\productionData\wo;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Imports\Penyelia\mtolImport;

use DB;
use Session;

class penyeliaController extends resourceController
{
    private $menu;
    private $username;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            // $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'Rollie - Penyelia')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

	public function index()
	{
		$hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
        $hakAksesAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
        
        if($hakAksesAplikasi == "1")
        {
            $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->first();
            $aplikasi = aplikasi::find($hakAksesUserAplikasi->id_aplikasi)->first();
            return redirect($aplikasi->link);
        }
        $i = 0;
        foreach ($hakAksesUserAplikasi as $h) 
        {
            $data[$i] = DB::table('aplikasi')->where('id', $h->id_aplikasi)->first();
            $i++;
        }
        // mengambil tanggal hari senin dan minggu  di minggu ini 
        $senin      = date("Y-m-d", strtotime('monday this week'));
        $minggu     = date("Y-m-d", strtotime('sunday this week'));

        // mengambil jadwal wo diminggu ini saja dan wo yang statusnya belum close di minggu-minggu sebelumnya 

        $wos        = wo::whereBetween('production_plan_date',[$senin,$minggu])->orWhere('status','!=','5')->orWhere('status','!=','6')->get();

        return view('rollie.penyelia.mtol',['menus' => $this->menu,'username' => $this->username, 'hakAkses' => $data,'wos'=>$wos]);

	}

    public function importJadwalProduksi(Request $request)
    {
        // pengecekan jenis upload
       if ($request->jenis_upload == '1') 
       {
            // ini untuk upload file
            if ($request->hasFile('jadwalUpload'))
            {
                // validasi ekstensi XLS , XLSX 
                $arrayekstensi  = ['xls','xlsx'];
                if (in_array($request->jadwalUpload->getClientOriginalExtension(), $arrayekstensi)) 
                {
                    // Apabila ekstensi XLS /  XLSX
                    $filejadwal     = $request->file('jadwalUpload');
                    $uploadjadwal = Excel::import(new mtolImport, $filejadwal);
                    return redirect()->route('penyelia-index')->with('success',"File Mtol Berhasil Di upload");
                }
                else
                {
                    // apabila ekstensi bukan XLS , XLSX
                    return back()->with('failed','Harap Attach File Excel Mtol dengan Format XLS atau XLSX');
                }
            }
            else
            {
                return back()->with('failed','Harap Attach File Excel Mtol');
            } 
       }
       else
       {
            // ini untuk table add
       }
    }
}
