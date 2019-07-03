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
use App\Models\productionData\cppHead;
use App\Models\productionData\cppDetail;
use App\Models\productionData\palet;
use App\Models\masterApps\mesinFilling;
use DB;
use \Carbon\Carbon;
use Session;

class rollieOperatorController extends resourceController
{
	private $menu;
    private $username;

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next)
        {
            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            // $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'Rollie - Operator Produksi')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

    public function fillpackindex()
    {
    	$hakAksesUserAplikasi      = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
        $hakAksesAplikasi          = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
        
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
        
        // mengambil jadwal wo diminggu ini saja dan wo yang statusnya WIP Filling di minggu-minggu sebelumnya 
        $wos        = wo::where('status','3')->orWhere('status','2')->whereNotIn('produk_id',['30','31','32'])->get();
        $cekyobase  = wo::where('status','3')->orWhere('status','2')->whereIn('produk_id',['30','31','32'])->get();
        return view('rollie.operator.dashboard',['menus' => $this->menu,'username' => $this->username, 'hakAkses' => $data,'wos'=>$wos]);
        // return view('rollie.operator.cpp');
    }

    public function prosesCpp(Request $request)
    {
        $wo_id                  = resourceController::dekripsi($request->wo_id);
        $wo                     = wo::find($wo_id);
        $start_packing          = date('Y-m-d');
        $insertCppHead          = cppHead::create([
                                    'produk_id'         => $wo->produk_id,
                                    'tanggal_packing'   => $start_packing,
                                    'status'            => '0'
                                ]);
        $wo->cpp_head_id        = $insertCppHead->id;
        $wo->expired_date       = date('Y-m-d',strtotime("+".$wo->produk->expired_range." months", strtotime($wo->production_realisation_date)));
        $wo->save();
        $return                 = resourceController::enkripsi($insertCppHead->id);
        return ['cpp_head_id'=>$return];


    }
    public function cpp($cpp_head_id)
    {    
        $cpp_head_id                = resourceController::dekripsi($cpp_head_id);
        $cpp_head                   = cppHead::find($cpp_head_id);
        return view('rollie.operator.cpp',['menus' => $this->menu,'username' => $this->username,'cpps'=>$cpp_head]);
    }

    public function tambahCpp(Request $request)
    {
        $wo_id                      = resourceController::dekripsi($request->wo_id);
        $wo                         = wo::find($wo_id);
        $mesin_filling_id           = resourceController::dekripsi($request->mesin_filling_id);
        $mesin_filling              = mesinFilling::find($mesin_filling_id);
        $cpp_head_id                = resourceController::dekripsi($request->cpp_head_id);
        $cppDetail                  = cppDetail::where('cpp_head_id',$cpp_head_id)->where('wo_id',$wo_id)->where('mesin_filling_id',$mesin_filling_id)->first();
        if (is_null($cppDetail)) 
        {
            $tahunproduksi  =   explode('-', $wo->production_realisation_date);
            $expired_date   =   explode('-', $wo->expired_date);
            $huruf          =   resourceController::tahunKeHuruf($tahunproduksi[0]);
            $length         =   strlen($mesin_filling->kode_mesin);
            $index          =   $length-1;
            $kode_mesin     =   $mesin_filling->kode_mesin[$index];
            $nolot          =   $huruf.$kode_mesin.$expired_date[1].$expired_date[2].'A';
            $cpp_detail     =   cppDetail::create([
                                    'cpp_head_id'           => $cpp_head_id,
                                    'wo_id'                 => $wo_id,
                                    'mesin_filling_id'      => $mesin_filling_id,
                                    'nolot'                 => $nolot
                                ]);
            // ini untuk mengecek palet nantinya yang mesinya sama. maka Nomor Palet akan continous
            $cpp_detail_lot     = cppDetail::where('nolot',$nolot)->first();
            //cek jumlah cpp jika nomor lot sama lebih dari satu maka paletnya akan continous deh
            $cekpalet           = palet::where('cpp_detail_id',$cpp_detail_lot->id)->latest()->first();
            $now                = date('Y-m-d H:i:s');
            if (is_null($cekpalet)) 
            {
                if (strpos($wo->produk->nama_produk,'Gundam')) 
                {    
                    palet::create([
                        'cpp_detail_id' => $cpp_detail->id,
                        'palet'         => 'P01G',
                        'start'         => $now
                    ]);
                }
                else
                {
                    palet::create([
                        'cpp_detail_id' => $cpp_detail->id,
                        'palet'         => 'P01',
                        'start'         => $now
                    ]);   
                }
            }
            elseif (!is_null($cekpalet)) 
            {
              
                $cekpalet->end      = $now;
                $cekpalet->save();
                if (strpos($wo->produk->nama_produk,'Gundam')) 
                {    
                    $pecah  = explode('G',$cekpalet->palet);
                    $pecah  = explode('P',$pecah[0]);
                    $palet  = $pecah[1]+1;
                    if (strlen($palet) == 1) 
                    {
                        $palet = "0".$palet;
                    }
                    $palet  = 'P'.$palet.'G';
                    palet::create([
                        'cpp_detail_id' => $cpp_detail->id,
                        'palet'         => $palet,
                        'start'         => $cekpalet->end
                    ]);
                }
                else
                {
                    $pecah  = explode('P',$cekpalet->palet);
                    $palet  = $pecah[1]+1;
                    if (strlen($palet) == 1) 
                    {
                        $palet = "0".$palet;
                    }
                    $palet  = 'P'.$palet;
                    palet::create([
                        'cpp_detail_id' => $cpp_detail->id,
                        'palet'         => $palet,
                        'start'         => $cekpalet->end
                    ]);

                }   
            }
            return ['success'=>true,'message'=>'berhasil'];
        }
        else
        {
            $cekpalet           = palet::where('cpp_detail_id',$cppDetail->id)->latest()->first();
            $now                = date('Y-m-d H:i:s');
            if (is_null($cekpalet)) 
            {
                if (strpos($wo->produk->nama_produk,'Gundam')) 
                {    
                    palet::create([
                        'cpp_detail_id' => $cppDetail->id,
                        'palet'         => 'P01G',
                        'start'         => $now
                    ]);
                }
                else
                {
                    palet::create([
                        'cpp_detail_id' => $cppDetail->id,
                        'palet'         => 'P01',
                        'start'         => $now
                    ]);   
                }
            }
            elseif (!is_null($cekpalet)) 
            {
                $cekpalet->end      = $now;
                $cekpalet->save();
            
                if (strpos($wo->produk->nama_produk,'Gundam')) 
                {    
                    $pecah  = explode('G',$cekpalet->palet);
                    $pecah  = explode('P',$pecah[0]);
                    $palet  = $pecah[1]+1;
                    if (strlen($palet) == 1) 
                    {
                        $palet = "0".$palet;
                    }
                    $palet  = 'P'.$palet.'G';
                    palet::create([
                        'cpp_detail_id' => $cppDetail->id,
                        'palet'         => $palet,
                        'start'         => $cekpalet->end
                    ]);
                }
                else
                {
                    $pecah  = explode('P',$cekpalet->palet);
                    $palet  = $pecah[1]+1;
                    if (strlen($palet) == 1) 
                    {
                        $palet = "0".$palet;
                    }
                    $palet  = 'P'.$palet;
                    palet::create([
                        'cpp_detail_id' => $cppDetail->id,
                        'palet'         => $palet,
                        'start'         => $cekpalet->end
                    ]);   
                }   
            }
        }
        return ['success'=>true];
    }

    public function refreshTableCpp($cpp_head_id)
    {
        $return     = array();
        $tampung    = array();
        $cpp_head_id    = resourceController::dekripsi($cpp_head_id);
        $cpp_head     = cppHead::find($cpp_head_id);
        foreach ($cpp_head->cppDetail as $key => $detail) 
        {
            foreach ($detail->palet as $key => $palet) 
            {
                $detail->palet              = $palet;    
                $detail->palet->id_detail   = resourceController::enkripsi($palet->id);
                array_push($return, $tampung);
            }
            $cpp_head->cpp_detail       = $detail;
        }
        return $cpp_head;
    }
    function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
                }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    public function ubahJamAwal(Request $request)
    {
        $palet_id       = resourceController::dekripsi($request->id_palet);
        $jam_start      = $request->jam_start;
        // ini mengambil palet nya 
        $palet          = palet::find($palet_id);
        // ini ambil semua palet dan cek palet sebelumnya
        $ambilsemua     = palet::where('cpp_detail_id',$palet->cpp_detail_id)->get();
        foreach ($ambilsemua as $key => $value) 
        {
            if ($value->id === $palet->id) 
            {
                $keyaktif   = $key;
            }
        }
        if ($keyaktif !== 0) 
        {
            if (!is_null($palet->end)) 
            {
                if ($jam_start >= $palet->end) 
                {
                    // ini jika jam start > dari jam end
                    return ['success'=>false,'message'=>'Jam awal palet tidak boleh melebihi dari jam akhir palet . Harap menyesuaikan jam akhir palet terlebih dahulu'];
                }   
                else if ($jam_start <= $ambilsemua[$keyaktif-1]->start)
                {
                    return ['success'=>false,'message'=>'Jam awal palet tidak boleh kurang dari jam awal palet sebelumnya. Harap menyesuaikan jam palet lebih awal terlebih dahulu'];
                }
                else if($jam_start < $palet->end && $jam_start > $ambilsemua[$keyaktif-1]->start)
                {
                    $paletsebelum           = $ambilsemua[$keyaktif-1];
                    $paletsebelum->end      = $jam_start;
                    $paletsebelum->save();

                    $palet->start           = $jam_start;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];

                }
            }
            else
            {
                if ($jam_start <= $ambilsemua[$keyaktif-1]->start)
                {
                    return ['success'=>false,'message'=>'Jam awal palet tidak boleh kurang dari jam awal palet sebelumnya. Harap menyesuaikan jam palet lebih awal terlebih dahulu'];
                }
                else if($jam_start > $ambilsemua[$keyaktif-1]->start && $jam_start > $palet->start)
                {
                    $paletsebelum           = $ambilsemua[$keyaktif-1];
                    $paletsebelum->end      = $jam_start;
                    $paletsebelum->save();

                    $palet->start           = $jam_start;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];

                }
            }
        }
        else
        {
            if (!is_null($palet->end)) 
            {
                if ($jam_start >= $palet->end) 
                {
                    // ini jika jam start > dari jam end
                    return ['success'=>false,'message'=>'Jam awal palet tidak boleh melebihi dari jam akhir palet . Harap menyesuaikan jam akhir palet terlebih dahulu'];
                }   
                else if($jam_start < $palet->end)
                {
                    $palet->start           = $jam_start;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];
                }
            }
            else
            {
                $palet->start           = $jam_start;
                $palet->save();
                return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];
            
            }
        }
    
    }
    public function ubahJamAkhir(Request $request)
    {
        $palet_id       = resourceController::dekripsi($request->id_palet);
        $jam_end        = $request->jam_end;
        // ini mengambil palet nya 
        $palet          = palet::find($palet_id);
        // ini ambil semua palet dan cek palet sebelumnya
        $ambilsemua     = palet::where('cpp_detail_id',$palet->cpp_detail_id)->get();
        foreach ($ambilsemua as $key => $value) 
        {
            if ($value->id === $palet->id) 
            {
                $keyaktif   = $key;
            }
        }
        if ($keyaktif !== 0) 
        {
            if (!is_null($ambilsemua[$keyaktif+1])) 
            {
                if ($jam_end <= $palet->start) 
                {
                    // ini jika jam start > dari jam end
                    return ['success'=>false,'message'=>'Jam Akhir palet tidak boleh lebih awal dari jam awal palet . Harap menyesuaikan jam awal palet terlebih dahulu'];
                }   
                else if ($jam_end >= $ambilsemua[$keyaktif+1]->end)
                {
                    return ['success'=>false,'message'=>'Jam Akhir palet tidak boleh lebih dari jam akhir palet sesudah. Harap menyesuaikan jam palet lebih akhir terlebih dahulu'];
                }
                else if($jam_end > $palet->start && $jam_end < $ambilsemua[$keyaktif+1]->end)
                {
                    $paletsesudah           = $ambilsemua[$keyaktif+1];
                    $paletsesudah->start    = $jam_end;
                    $paletsesudah->save();

                    $palet->end           = $jam_end;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Akhir Berhasil Diubah'];

                }
            }
            else
            {
                if ($jam_end <= $palet->start) 
                {
                    // ini jika jam start > dari jam end
                    return ['success'=>false,'message'=>'Jam Akhir palet tidak boleh lebih awal dari jam awal palet . Harap menyesuaikan jam awal palet terlebih dahulu'];
                }
                else if($jam_end > $palet->start)
                {
                    $palet->end           = $jam_end;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Akhir Berhasil Diubah'];

                }
            }
        }
        else
        {
            if (!is_null($palet->start)) 
            {
                if ($jam_end <= $palet->start) 
                {
                    // ini jika jam start > dari jam end
                    return ['success'=>false,'message'=>'Jam akhir palet tidak boleh kurang dari jam awal palet . Harap menyesuaikan jam awal palet terlebih dahulu'];
                }   
                else if($jam_end > $palet->start)
                {
                    $palet->end           = $jam_end;
                    $palet->save();
                    return ['success'=>true,'message'=>'Jam Awal Berhasil Diubah'];
                }
            }
        }
    
    }
}
