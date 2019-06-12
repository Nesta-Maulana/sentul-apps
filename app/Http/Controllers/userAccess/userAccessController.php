<?php

namespace App\Http\Controllers\userAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAccess\userAccess;
use Illuminate\Support\Facades\Hash;
use App\Models\masterApps\aplikasi;
use DB;
use Session;

class userAccessController extends Controller
{
    public function index(){
        if(Session::get('login'))
        {
            return redirect(url()->previous())->with('failed', 'Anda harus logout terlebih dahulu');
        }
        return view('userAccess.loginRegister');
    }
    public function logout(){
        Session::pull('login', null);
        Session::pull('aplikasi', null);
        Session::pull('tambah', null);
        Session::pull('ubah', null);
        Session::pull('hapus', null);
        Session::pull('lihat', null);
        return redirect('/');
    }
    // public function register(){
    //     return view('userAccess.register');
    // }
    public function dashboard(){
        return view('userAccess.admin.index');
    }
    public function login(Request $request){
        
        $username = $request->username;
        $password = $request->password;
        $data = new userAccess();
        if($data = $data::where('username', $username)->first()){
            if($username === $data->username){
                if(Hash::check($password, $data->password)){
                    if($data->status == 0){
                        return redirect(route('halaman-login'))->with('failed', 'Hubungi admin untuk melakukan verifikasi');
                    }else{
                        if($data->verified == "1"){
                            if($data->verifiedByAdmin == "1")
                            {
                                $to = \Carbon\Carbon::now('Asia/Jakarta');
                                $from = $data->lastUpdatePassword;
                                $diff_in_days = $to->diffInDays($from);
                                if($diff_in_days >= 30){
                                    return "Pindah Ke halaman Ganti password";
                                }else{
                                    session()->put('login', $data->id);
                                    $hak_aplikasi = DB::table('hak_akses_aplikasi')->where('id_user', $data->id)->get();
                                    
                                    if(count($hak_aplikasi) > "1"){ 
                                        $user = userAccess::find(Session::get('login'));
                                        $user->update([
                                            'passwordWrong' => '0' 
                                        ]);
                                        return redirect('home')->with('success', "Selamat Datang" . $data->fullname);
                                    } else if(count($hak_aplikasi) == "1"){
                                        foreach ($hak_aplikasi as $h ) {
                                            $aplikasi = aplikasi::where('id', $h->id_aplikasi)->first();
                                        }
                                        $user = userAccess::find(Session::get('login'));
                                        $user->update([
                                            'passwordWrong' => '0' 
                                        ]);
                                        return redirect($aplikasi->link)->with('success', "Selamat Datang" . $data->fullname);
                                    }else{
                                        return redirect(route('halaman-login'))->with('failed', 'Anda tidak memiliki akses apapun');
                                    }
                                }
                            } else{
                                return redirect(route('halaman-login'))->with('failed', 'Harap hubungi admin untuk melakukan verifikasi');
                            }
                        } else {
                            return redirect(route('halaman-login'))->with('failed', 'Harap Aktivasi akun anda terlebih dahulu !');
                        }
                    }
                } else 
                {
                    if($data->passwordWrong >= 3)
                    {
                        $data->status = "0";
                        $data->save();
                        return redirect(route('halaman-login'))->with('failed', 'Harap hubungi admin !');
                    } 
                    else{
                        $passwordWrong = $data->passwordWrong + 1;
                    $data->passwordWrong = $passwordWrong;
                    $data->save();
                        $kesempatan = 3 - $passwordWrong;
                        if($kesempatan == "0"){
                            $kesempatan = "sudah habis";
                        }else{
                            $kesempatan = "tersisa " . $kesempatan . " lagi"; 
                        }
                        return redirect(route('halaman-login'))->with('failed', 'Password yang anda masukkan salah, kesempatan anda ' . $kesempatan);
                    }
                }
            }else{
                return redirect(route('halaman-login'))->with('failed', 'Username yang anda masukkan tidak terdaftar');
            }
        }else{
            return redirect(route('halaman-login'))->with('failed', 'Username yang anda masukkan tidak terdaftar');
        }
    }
}
