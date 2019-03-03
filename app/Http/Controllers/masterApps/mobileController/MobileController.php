<?php

namespace App\Http\Controllers\masterApps\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\General\UserAccess\userAccess;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;

class MobileController extends Controller
{
    public function index(){
        return view('masterApps/mobile/login');
    }
    public function register(){
        return view('masterApps/mobile/register');
    }
    public function dashboard(){
        return view('masterApps/mobile/admin/index');
    }
    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $data = new userAccess();
        if($data = $data::where('email', $email)->first()){
            if($email === $data->email){
                if(Hash::check($password, $data->password)){
                    if($data->status == 0){
                        return redirect('login-form')->with('failed', 'Hubungi admin untuk melakukan verifikasi');
                    }else{
                        if($data->verified == "1"){
                            if($data->verifiedByAdmin == "1"){
                                $to = \Carbon\Carbon::now('Asia/Jakarta');
                                $from = $data->lastUpdatePassword;
                                $diff_in_days = $to->diffInDays($from);
                                if($diff_in_days >= 30){
                                    return "Pindah Ke halaman Ganti password";
                                }else{
                                    session()->put('login', $data->id);
                                    $hak_aplikasi = DB::table('hak_akses_aplikasi')->where('id_user', $data->id)->get();
                                    if(count($hak_aplikasi) > "1"){
                                        return redirect('home')->with('success', "Selamat Datang" . $data->fullname);
                                    } else if(count($hak_aplikasi) == "1"){
                                        return redirect('masterApps/form-user');
                                    }else{
                                        return redirect('login-form')->with('failed', 'Anda tidak memiliki akses apapun');
                                    }
                                }
                            } else{
                                return redirect('login-form')->with('failed', 'Harap hubungi admin untuk melakukan verifikasi');
                            }
                        } else {
                            return redirect('login-form')->with('failed', 'Harap Aktivasi akun anda terlebih dahulu !');
                        }
                    }
                } else {
                    if($data->passwordWrong >= 3){
                        $data->status = "0";
                        $data->save();
                        return redirect('login-form')->with('failed', 'Harap hubungi admin !');
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
                        return redirect('login-form')->with('failed', 'Password yang anda masukkan salah, kesempatan anda ' . $kesempatan);
                    }
                }
            }else{
                return redirect('login-form')->with('failed', 'Email anda tidak terdaftar');
            }
        }else{
            return redirect('login-form')->with('failed', 'Email anda tidak terdaftar');
        }
    }
}
