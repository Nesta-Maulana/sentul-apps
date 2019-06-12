<?php

namespace App\Http\Controllers\userAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\UserAccess\userAccess;
use App\Models\UserAccess\role;
use Illuminate\Support\Facades\Hash;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\agama;
use \Carbon\Carbon;
use DB;
use Session;

class userAccessController extends resourceController
{

    public function index(){
        // dd(session()->all());
        $agama = agama::all();
        $roles = role::all();
        if(Session::get('login'))   
        {
            return redirect(url()->previous())->with('error', 'Anda harus logout terlebih dahulu');
        }
        
        return view('userAccess.loginRegister', ['agama' => $agama, 'roles' => $roles]);
    }
    public function logout(){
        Session::pull('login', null);
        Session::pull('loginNoAkses', null);
        Session::pull('aplikasi', null);
        Session::pull('tambah', null);
        Session::pull('ubah', null);
        Session::pull('hapus', null);
        Session::pull('lihat', null);
        return redirect('/');
    }
    public function gantiPassword($id){
        
        if(Session::get('ganti-password') != $id){
            return back()->with('failed', 'Dilarang mengakses menu ini');
        }
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $username = userAccess::find($id);
        
        return view('userAccess.gantiPassword', ['username' => $username->username]);
    }
    public function gantiUserPassword(Request $request){
        
        $user = userAccess::where('username', $request->username)->first();
        if(!$user){
            return back()->with('failed', 'Username tidak sesuai');
        }
        if($request->newPassword !== $request->cNewPassword){
            return back()->with('failed', 'Konfirmasi password tidak sesuai');
        }
        
        if(Hash::check($request->oldPassword, $user->password)){
            $today = Carbon::today();
            $today = $today->toDateString();
            $user->password = Hash::make($request->newPassword);
            $user->lastUpdatePassword = $today;
            $user->save();
            session()->pull('ganti-password', null);
            return redirect('/login-form')->with('success', 'Password berhasil diubah');
        }
        else {
            return back()->with('failed', 'Password lama tidak sesuai');
        }

    }
    // public function dashboard(){
    //     return view('userAccess.admin.index');
    // }
    public function login(Request $request){
        // dd(Hash::make('1234'));
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
                            if($data->verifiedByAdmin == "1"){
                                $to = \Carbon\Carbon::now('Asia/Jakarta');
                                $from                   = $data->lastUpdatePassword;
                                $fromupdate             = $data->updated_at;
                                $diff_in_days           = $to->diffInDays($from);
                                $diff_in_days_update    = $to->diffInDays($fromupdate);
                                
                                if($diff_in_days >= 30 && $diff_in_days_update >= 7)
                                {
                                    
                                    $id = resourceController::enkripsi($data->id);
                                    
                                    session()->put('ganti-password', $id);
                                    return redirect('ganti-password/' . $id)->with('failed', 'Password anda sudah lebih dari 30 hari, harap ganti password !');
                                }
                                else if($diff_in_days >= 30 && $diff_in_days_update < 7)
                                {
                                    $id = resourceController::enkripsi($data->id);
                                    
                                    session()->put('ganti-password', $id);
                                    return redirect('ganti-password/' . $id)->with('failed', 'Pengguna baru harap ganti password anda');
                                }
                                else
                                {
                                    $hak_aplikasi = DB::table('hak_akses_aplikasi')->where('id_user', $data->id)->get();
                                    
                                    session()->put('login', $data->id);
                                    if(count($hak_aplikasi) >= "1"){ 
                                        $user = userAccess::find(Session::get('login'));
                                        $user->update([
                                            'passwordWrong' => '0' 
                                        ]);
                                        return redirect('home')->with('success', "Selamat Datang" . $data->fullname);
                                    }else{
                                        
                                        return redirect('home')->with('success', "Selamat Datang" . $data->fullname);
                                    }
                                }
                            } else{
                                return redirect(route('halaman-login'))->with('failed', 'Harap hubungi admin untuk melakukan verifikasi');
                            }
                        } else {
                            return redirect(route('halaman-login'))->with('failed', 'Harap Aktivasi akun anda terlebih dahulu !');
                        }
                    }
                } else {
                    if($data->passwordWrong >= 3){
                        $data->status = "0";
                        $data->save();
                        return redirect(route('halaman-login'))->with('failed', 'Harap hubungi admin !');
                    } else{
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
    public function register(Request $request){
        $today = Carbon::today();
        $today = $today->addDay('-30');
        // Cek Username
        $checkUsername = userAccess::where('username', $request->username)->count();
        if($checkUsername > 0){
            return back()->with('failed', 'Username Sudah Terdaftar');
        }
        $oldCountUser =  userAccess::count();
        $oldCountKaryawan = karyawan::count();
        $password = Hash::make('sentulappuser');
        userAccess::create([
            'rolesId' => $request->role,
            'username' => $request->username,
            'password' => $password,
            'verified' => '0',
            'verifiedByAdmin' => '0',
            'lastUpdatePassword' => $today, 
            'passwordWrong' => '0',
            'status' => '0',
        ]);
        karyawan::create([
            'nik' => $request->username,
            'fullname' => $request->fullname,
            'jk' => $request->jk,
            'marital_status' => $request->status,
            'tempat_lahir' => $request->tempatLahir,
            'agama_id' => $request->agama,
            'golongan_darah' => $request->golDarah,
            'email' => $request->email,
        ]);
        $newCountUser =  userAccess::count();
        $newCountKaryawan = karyawan::count();
        // Cek Berhasil / Tidak
        if($newCountKaryawan > $oldCountKaryawan && $newCountUser > $oldCountUser){
            return back()->with('success', 'Berhasil Mendaftar');
        }else{
            return back()->with('failed', 'Gagal Mendaftar');
        }
        
    }
}
