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
use App\Models\productionData\wo;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Imports\Penyelia\mtolImport;
use App\Imports\mtolUpload;
use Illuminate\Http\RedirectResponse;
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

        $wos        = wo::whereBetween('production_plan_date',[$senin,$minggu])->WhereNotIn('status',['5','6'])->get();
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
                    $filejadwal         = $request->file('jadwalUpload');
                    $uploadjadwal       =   Excel::toArray(new mtolUpload, $filejadwal);
                    $cektidaknull       = array();
                    for ($i=4; $i < count($uploadjadwal['Mampu Telusur Produk Online (MT']) ; $i++) 
                    { 
                        if ($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3] !== "" && !is_null($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3]) && $uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9] && !is_null($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9]) && $uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8] !== "" && !is_null($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8])) 
                        {
                            // array_push($cektidaknull,$uploadjadwal['Mampu Telusur Produk Online (MT'][$i]);
                            if (strpos($uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3], '/')) 
                            {
                                $patahkan           = explode('/',$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][3]);
                                $kode_trial         = end($patahkan);
                                $cekproduk          = produk::where('kode_trial',$kode_trial)->first();
                                if (is_null($cekproduk)) 
                                {
                                    return redirect()->route('penyelia-jadwal-dashboard')->with('failed','Item '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9].' dengan kode oracle '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8].' belum terdaftar. Harap hubungi administrator untuk menyelesaikannya');
                                }                            } 
                            else
                            {
                                $cekproduk  = produk::where('kode_oracle',$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8])->first();
                                if (is_null($cekproduk)) 
                                {
                                    return redirect()->route('penyelia-jadwal-dashboard')->with('failed','Item '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][9].' dengan kode oracle '.$uploadjadwal['Mampu Telusur Produk Online (MT'][$i][8].' belum terdaftar. Harap hubungi administrator untuk menyelesaikannya');
                                }
                                
                            }

                        }   
                    }
                    $uploadjadwal   =   Excel::import(new mtolUpload, $filejadwal);
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
                // apabila file attach
                return back()->with('failed','Harap Attach File Excel Mtol');
            } 
        }
        else
        {
            $cek = wo::all()->count();
            for ($i=0; $i < count($request->wo); $i++) { 
                wo::create([
                "nomor_wo" => $request->wo[$i],
                "produk_id" => $request->nama_produk[$i],
                "production_plan_date" => $request->plan_date[$i] . ' 00:00:00',
                "plan_id" => $request->nama_plan[$i],
                "plan_batch_size" => $request->plan_batch_size[$i],
                "status" => $request->status[$i],
                "revisi_formula" => $request->revisi_formula[$i],
                ]);
            }   
            if($cek <= $i)
            {
                return "Gagal";
            }
            else
            {
                return back()->with('success', "Berhasil Menambahkan");
            }
        }
    }
    public function cancel(Request $request)
    {    
        $id = app('App\Http\Controllers\resourceController')->dekripsi($request->id);
        $wo = wo::find($id);
        $wo->status = '6';
        $wo->keterangan_2 = $request->alasan;
        $wo->save();
        return $wo;
    }
    public function prosesWo(Request $request)
    {
        $idwo               = resourceController::dekripsi($request->proses_id);
        $nowo               = $request->nomor_wo_proses;
        $realisation_date   = $request->realisation_date;
        $wo                 = wo::find($idwo);
        $wo->production_realisation_date    = $realisation_date;
        $wo->status                         = '2';
        $wo->save();
        return redirect()->route('penyelia-jadwal-dashboard')->with('success','Produki dengan nomor wo '.$nowo.' sudah melakukan proses mixing');
    }
}
