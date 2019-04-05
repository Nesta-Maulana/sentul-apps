<?php

namespace App\Http\Controllers\utilityOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\karyawan;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\penggunaan;
use App\Models\utilityOnline\bagian;
use DB;
use Session;

class adminUtilityController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            // dd(Session::all());

            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'utility Online')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

    public function index(){
        return view('utilityOnline.admin.index', ['menus' => $this->menu, 'username' => $this->username]);
    }
    public function report(){
        $report = penggunaan::all();
        $bagian = bagian::all();
        return view('utilityOnline.admin.report', ['menus' => $this->menu, 'username' => $this->username, 'report' => $report, 'bagian' => $bagian]);
    }
}
