<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;

class CekLogin
{
    public function handle($request, Closure $next)
    {
        $id = Session::get('login');
        $userData = DB::table('users')->where('id', $id);
        if($userData->count() > 0){
            $isi = url()->full();    
            $data = explode("http://localhost/sentul-apps/" , $isi);
            $data = explode('/',$data[1]);
            $i = 0;
            foreach($data as $d){
                $i++;
            }
            if($i == '1'){
                $data[1] = "";
            }
            $cekHakAkses = DB::table('v_hak_akses')->where('link', $data[1]);
            if($cekHakAkses->count() > 0){
                $cekHakAkses = $cekHakAkses->first();
                if($cekHakAkses->lihat == "0"){
                    return redirect(url()->previous())->with('failed', 'Anda tidak memiliki akses terhadap menu ini');
                }else{
                    if($cekHakAkses->tambah == "0"){
                        Session::put('tambah', 'hidden');
                        if($cekHakAkses->ubah == "0"){
                            Session::put('ubah', 'hidden');
                            if($cekHakAkses->hapus == "0"){
                                Session::put('hapus', 'hidden');
                            }else{
                                Session::put('hapus', 'show');
                            }
                        }else{
                            Session::put('ubah', 'show');
                            if($cekHakAkses->hapus == "0"){
                                Session::put('hapus', 'hidden');
                            }else{
                                Session::put('hapus', 'show');
                            }
                        }
                    }
                    else{
                        Session::put('tambah', 'show');
                        if($cekHakAkses->ubah == "0"){
                            Session::put('ubah', 'hidden');
                            if($cekHakAkses->hapus == "0"){
                                Session::put('hapus', 'hidden');
                            }else{
                                Session::put('hapus', 'show');
                            }
                        }else{
                            Session::put('ubah', 'show');
                            if($cekHakAkses->hapus == "0"){
                                Session::put('hapus', 'hidden');
                            }else{
                                Session::put('hapus', 'show');
                            }
                        }
                    }
                }
            }
            Session::put('aplikasi', $data[0]);
            
            app()->instance('usersData', $userData->first());
            $cekHakAkses = DB::table('hak_akses_menu')->where('user_id', $id)->get();
            $request->merge(['cekHakAkses' => $cekHakAkses]);
            return $next($request);
        } else{
            return redirect('login-form')->with('failed', 'Anda harus login terlebih dahulu');
        }
    }
}
