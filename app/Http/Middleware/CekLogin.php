<?php

namespace App\Http\Middleware;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use Closure;
use Session;
use DB;

class CekLogin
{
    public function handle($request, Closure $next)
    {
        
        $id = Session::get('login');
        $userData = DB::connection('master_apps')->table('users')->where('id', $id);
        if($userData->count() > 0){
            $isi = url()->full();
            $data = explode($_SERVER['HTTP_HOST']."/sentul-apps" , $isi);
            $data = explode('/',$data[1]);
            $i = 0;
            foreach($data as $d)
            {
                $i++;
            }
            if($i == '1'){
                $data[1] = "";
            }else if($i == '2'){
                $data[2] = "";
            }
            
            $aplikasi = hakAksesUserAplikasi::where('id_user', $id)->where('status', '1')->get();
            
            $useraplikasi = array();
            foreach ($aplikasi as $a)
            {
                $hakAplikasi = aplikasi::where('id', $a->id_aplikasi)->first();
                array_push($useraplikasi,$hakAplikasi->link);
            }
            
            if($data[1] !== 'home' && !in_array($data[1],$useraplikasi))
            {
                return redirect(url()->previous())->with('failed', 'Anda tidak memiliki akses terhadap aplikasi ini');
            }
            else
            {   
                $cekHakAkses = DB::connection('master_apps')->table('v_hak_akses')->where('link', $data[2])->where('user_id', $id);
                if($cekHakAkses->count() > 0){
                    
                    $cekHakAkses = $cekHakAkses->first();
                    if($cekHakAkses->lihat == "0")
                    {
                        return redirect(url()->previous())->with('failed', 'Anda tidak memiliki akses terhadap menu ini');
                    }
                    else
                    {
                        if($cekHakAkses->tambah == "0")
                        {
                            Session::put('tambah', 'hidden');
                            if($cekHakAkses->ubah == "0")
                            {
                                Session::put('ubah', 'hidden');
                                if($cekHakAkses->hapus == "0")
                                {
                                    Session::put('hapus', 'hidden');
                                }
                                else
                                {
                                    Session::put('hapus', 'show');
                                }
                            }
                            else
                            {
                                Session::put('ubah', 'show');
                                if($cekHakAkses->hapus == "0")
                                {
                                    Session::put('hapus', 'hidden');
                                }
                                else
                                {
                                    Session::put('hapus', 'show');
                                }
                            }
                        }
                        else
                        {
                            Session::put('tambah', 'show');
                            if($cekHakAkses->ubah == "0")
                            {
                                Session::put('ubah', 'hidden');
                                if($cekHakAkses->hapus == "0")
                                {
                                    Session::put('hapus', 'hidden');
                                }
                                else
                                {
                                    Session::put('hapus', 'show');
                                }
                            }
                            else
                            {
                                Session::put('ubah', 'show');
                                if($cekHakAkses->hapus == "0")
                                {
                                    Session::put('hapus', 'hidden');
                                }
                                else
                                {
                                    Session::put('hapus', 'show');
                                }
                            }
                        }
                    }
                }
                
                Session::put('aplikasi', $data[0]);
                
                app()->instance('usersData', $userData->first());
                $cekHakAkses = DB::connection('master_apps')->table('hak_akses_menu')->where('user_id', $id)->get();
                
                $request->merge(['cekHakAkses' => $cekHakAkses]);
                return $next($request);
            
            }

            
        } 
        else
        {
            return redirect('login-form')->with('failed', 'Anda harus login terlebih dahulu');
        }
    }
}