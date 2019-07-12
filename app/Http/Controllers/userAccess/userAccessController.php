<?php

namespace App\Http\Controllers\userAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\UserAccess\userAccess;
use App\Models\UserAccess\role;
use Illuminate\Support\Facades\Hash;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\menu;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\departemen;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use Illuminate\Support\Facades\Mail;
use \Carbon\Carbon;
use DB;
use App\Mail\userAccess\VerifyUser;
use App\Mail\userAccess\verifiedUser;
use Session;

class userAccessController extends resourceController
{

    public function index()
    {
        // dd(session()->all());
        $departemen = departemen::all();
        $roles = role::all();
        if(Session::get('login'))   
        {
            return redirect(url()->previous())->with('error', 'Anda harus logout terlebih dahulu');
        }
        
        return view('userAccess.loginRegister', ['departemen' => $departemen, 'roles' => $roles]);
    }
    public function logout()
    {
        Session::pull('login', null);
        Session::pull('loginNoAkses', null);
        Session::pull('aplikasi', null);
        Session::pull('tambah', null);
        Session::pull('ubah', null);
        Session::pull('hapus', null);
        Session::pull('lihat', null);
        return redirect('/');
    }
    public function gantiPassword($id)
    {
        if(Session::get('ganti-password') != $id){
            return back()->with('failed', 'Dilarang mengakses menu ini');
        }
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $username = userAccess::find($id);
        
        return view('userAccess.gantiPassword', ['username' => $username->username]);
    }
    public function gantiUserPassword(Request $request)
    {    
        $user = userAccess::where('username', $request->username)->first();
        if(!$user)
        {
            return back()->with('failed', 'Username tidak sesuai');
        }
        if($request->newPassword !== $request->cNewPassword)
        {
            return back()->with('failed', 'Konfirmasi password tidak sesuai')->withInput();
        }
        if (strlen($request->newPassword) < 6) 
        {
            return back()->with('failed', 'Password harus terdiri dari minimal 6 karakter')->withInput();
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
    public function login(Request $request)
    {
        // dd(Hash::make('1234'));
        $username = $request->username;
        $password = $request->password;
        $data = new userAccess();
        if($data = $data::where('username', $username)->first())
        {
            if($username === $data->username)
            {
                if($data->verified == "1")
                {
                    if($data->verifiedByAdmin == "1")
                    {
                        if($data->status == 0)
                        {
                            return redirect(route('halaman-login'))->with('failed', 'Hubungi admin untuk melakukan aktivasi akun anda');
                        }
                        else
                        {
                            if (Hash::check($password, $data->password)) 
                            {
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
                                    return redirect('ganti-password/' . $id)->with('info', 'Selamat datang di Sentul Integrated System. Demi keamanan akun anda, harap ganti password anda untuk pertama kalinya.');
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
                            }
                            else
                            {
                                if($data->passwordWrong >= 3)
                                {
                                    $data->status = "0";
                                    $data->save();
                                    return redirect(route('halaman-login'))->with('failed', 'Akun anda terkunci harap hubungi admin untuk aktivasi akun anda !');
                                } 
                                else
                                {
                                    $passwordWrong = $data->passwordWrong + 1;
                                    $data->passwordWrong = $passwordWrong;
                                    $data->save();
                                    $kesempatan = 3 - $passwordWrong;
                                    if($kesempatan == "0")
                                    {
                                        $data->status = "0";
                                        $data->save();
                                        $kesempatan = "sudah habis";
                                        return redirect(route('halaman-login'))->with('failed', 'Password yang anda masukan salah, 3 Kesempatan anda sudah habis. Akun anda kami nonaktifkan untuk sementara waktu demi menjaga keamanan dan privasi anda. Harap hubungi Administrator untuk mengaktifkan akun anda kembali.');
                                    }else{
                                        $kesempatan = "tersisa " . $kesempatan . " lagi"; 
                                        return redirect(route('halaman-login'))->with('failed', 'Password yang anda masukkan salah, kesempatan anda ' . $kesempatan);
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        return redirect(route('halaman-login'))->with('failed', 'Harap hubungi admin untuk melakukan verifikasi akun anda');
                    }
                } 
                else 
                {   
                    return redirect(route('halaman-login'))->with('failed', 'Harap verifikasi akun anda terlebih dahulu!');
                }
            }
            else
            {
                return redirect(route('halaman-login'))->with('failed', 'Username yang anda masukkan tidak terdaftar');
            }
        }else{
            return redirect(route('halaman-login'))->with('failed', 'Username yang anda masukkan tidak terdaftar');
        }
    }
    public function register(Request $request)
    {
        $today = Carbon::today();
        $today = $today->addDay('-30');
        // Cek Username
        $checkUsername = userAccess::where('username', $request->username)->count();
        if($checkUsername > 0)
        {
            return back()->with('failed', 'Username Sudah Terdaftar');
        }
        
        $oldCountUser       =   userAccess::count();
        $oldCountKaryawan   =   karyawan::count();
        $password           =   Hash::make('sentulappuser');
        $user               =   userAccess::create([
                                    'rolesId'               => $request->role,
                                    'username'              => $request->username,
                                    'password'              => $password,
                                    'verified'              => '0',
                                    'verifiedByAdmin'       => '0',
                                    'lastUpdatePassword'    => $today, 
                                    'passwordWrong'         => '0',
                                    'status'                => '0',
                                ]);
                                karyawan::create([
                                    'nik'                   => $request->username,
                                    'fullname'              => $request->fullname,
                                    'departemen_id'         => $request->departemen,
                                    'email'                 => $request->email,
                                ]);
        // Input Hak Akses
        $menus = menu::all();
        foreach ($menus as $menu ) 
        {
            $cekakses = DB::table('hak_akses_menu')->select('*')->where('user_id',$user->id)->where('menu_id',$menu->id)->count();
            if($cekakses == 0)
            {
                hakAksesAplikasi::create([
                'user_id' =>$user->id,
                'menu_id' => $menu->id,
                'lihat' => '0',
                'tambah' => '0',
                'ubah' => '0',
                'hapus' => '0',
                ]);
            }
        }
        $aplications = aplikasi::all();
        foreach ($aplications as $aplication ) 
        {
            $cekAplikasiAkses = hakAksesUserAplikasi::select('*')->where('id_user',$user->id)->where('id_aplikasi',$aplication->id)->count();
            if($cekAplikasiAkses == 0)
            {
                hakAksesUserAplikasi::create([
                    'id_aplikasi' => $aplication->id,
                    'id_user' => $user->id,
                    'status' => '0',
                ]);
            }
        }
        $newCountUser =  userAccess::count();
        $newCountKaryawan = karyawan::count();
        // Cek Berhasil / Tidak
        if($newCountKaryawan > $oldCountKaryawan && $newCountUser > $oldCountUser)
        {
            Mail::to($request->email)->send(new VerifyUser($request->all()));
            return back()->with('success', 'Anda berhasil mendaftar di portal Sisy. Harap cek inbox email anda untuk verifikasi akun anda.');
        }
        else
        {
            return back()->with('failed', 'Gagal Mendaftar');
        }
        
    }
    public function verifikasiUser($nik)
    {
        $nik        = resourceController::dekripsi($nik);
        $userdata   = userAccess::where('username',$nik)->first();
        $userdata->verified     = '1';
        $userdata->save();
        Mail::to('nesta.maulana@nutrifood.co.id')->send(new verifiedUser($userdata));    
        return redirect()->route('halaman-login')->with('success', 'Terima kasih sudah memverifikasi akun anda. Akun anda akan aktif setelah Administrator kami memverifikasi akun anda dan mengaktifkannya.');
    }
}
