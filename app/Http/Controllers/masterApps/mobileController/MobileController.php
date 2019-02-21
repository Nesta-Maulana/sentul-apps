<?php

namespace App\Http\Controllers\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\UserAccess\userAccess;
use Illuminate\Support\Facades\Hash;
use Session;

class MobileController extends Controller
{
    public function index(){
        return view('mobile/login');
    }
    public function register(){
        return view('mobile/register');
    }
    public function dashboard(){
        return view('mobile/admin/index');
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
                                    return redirect('/super/form-user');
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
