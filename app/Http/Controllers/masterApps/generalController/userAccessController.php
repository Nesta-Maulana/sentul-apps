<?php

namespace App\Http\Controllers\generalController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\userAccess\userAccess;
use App\Models\General\userAccess\role;
use App\Mail\userAccess\VerifyUser;

class userAccessController extends Controller
{
    public function index()
    {
        $roles = new role;
        $roles = $roles->where('id','!=','1')->where('status','!=','0')->pluck('role','id')->prepend("choose one rule what you want to access");
        return view('general.login.login')->withTitle("Selamat Datang,")->withPesan(" di Mollie - Mixing Online ")->withRoles($roles);
    }
    public function loginUser(Request $request)
    {
        dd($request->all());
    }
    public function signupUser(Request $request)
    {
        $validate   = Validator::make($request->all(),[
            '_token'    => 'required',
            'fullname'  => 'required|string|max:100',
            'email'     => 'required|email|max:75',
            'password'  => 'required|confirmed|min:6',
            'roles'      => 'required'
        ]);
        if($validate->passes())
        {
            $userTable  = new userAccess;
            $cekEmail   = $userTable->where('email',$request->email)->first();
            if($cekEmail)
            {
                return redirect()->route('user.masuk')->withError('warning')->withPesan('Email Sudah Terdaftar');
            }
            else
            {
                $userTable->fullname        = $request->fullname;
                $userTable->password        = $request->password;
                $userTable->email           = $request->email;
                $userTable->verified        = '0';
                $userTable->verifiedByAdmin = '0';
                $userTable->lastUpdatePassword = date('Y-m-d');
                $userTable->status          = '0';
                $userTable->rolesId         = $request->roles;
                $userTable->save();
                Mail::to($request->email)
                ->send(new VerifyUser($userTable));
                return redirect()->route('user.masuk')->withError('info')->withPesan('Email Verifikasi sudah terkirim ke emailmu.');
            }
        }
        else
        {

        }

        
        
    }
}