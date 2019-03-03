<?php

namespace App\Http\Controllers\masterApps\MobileController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\General\userAccess\userAccess;
use App\Models\masterApps\General\userAccess\role;
use App\Models\masterApps\Mobile\hakAkses;
use App\Models\masterApps\Mobile\menu;
use App\Models\masterApps\Mobile\hakAksesAplikasi;
use App\Models\masterApps\Mobile\hakAksesUserAplikasi;
use App\Models\masterApps\Mobile\aplikasi;
use Session;
use DB;

class superAdminController extends Controller
{
    private $menu;
    private $username;

    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            $this->username = resolve('usersData');
            $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'Master Apps')
            ->get();
            return $next($request);
        });
    }

    public function index(){
        $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->get();
        $i = 0;
        foreach ($hakAksesUserAplikasi as $h) {
            $data[$i] = DB::table('aplikasi')->where('id', $h->id_aplikasi)->first();
            $i++;
        }
        return view('masterApps.mobile.home', ['menus' => $this->menu, 'username' => $this->username, 'hakAkses' => $data]);
    }

    public function menu(Request $request){
        $aplikasi = aplikasi::get();
        $icons = DB::table('icons')->get();
        $parents = DB::table('menus')->where('parent_id', '0')->get();
        $allMenu = DB::table('menus')->get();
        return view('masterApps.mobile.superAdmin.formMenu', ['icons' => $icons, 'menus' => $this->menu, 'parents' => $parents, 'allMenu' => $allMenu, 'username' => $this->username, 'aplikasi' => $aplikasi]);
    }
    public function urutan($id){
        $urutan = DB::table('menus')->where('parent_id', $id)->get();
        return $urutan;
    } 
    public function pmb(){
        return view('masterApps.mobile.superAdmin.formPmb', ['menus' => $this->menu, 'username' => $this->username]);
    }
    public function user(){
        $users = new userAccess;
        $countUnverify = DB::table('users')->where('verifiedByAdmin', '0')->count();
        $countLogin = $users::where('status', '=', '1')->count();
        $countVerify = DB::table('users')->where('verifiedByAdmin', '1')->count();
        $user = DB::table('users')->where('rolesId', '!=', '1')->paginate(10);

        return view('masterApps.mobile.superAdmin.formUser', ['user' => $user, 'countUnverify' => $countUnverify, 
        'countVerify' => $countVerify, 'countLogin' => $countLogin, 'menus' => $this->menu, 'username' => $this->username]);
    }

    public function hakAkses(){
        $hakAkses = hakAkses::all();
        $user = userAccess::all();
        return view('masterApps.mobile.superAdmin.formHakAkses', ['menus' => $this->menu, 'hakAkses' => $hakAkses, 'users' => $user, 'username' => $this->username]);
    }

    public function brand(){

        return view('masterApps.mobile.superAdmin.formbrand', ['menus' => $this->menu, 'username' => $this->username]);
    }
    public function roles(){

        $roles = new role();
        $roles = $roles->all();
        $roles1 = $roles->all();
        $roles2 = $roles->count();
        for($i = 1; $i <= $roles2; $i++){
            $cek[$i] = DB::table('users')->where('rolesId', $i)->count();
        }
        return view('masterApps.mobile.superAdmin.formroles', ['roles' => $roles], ['users' => $cek, 'menus' => $this->menu, 'username' => $this->username]);
    }
    public function verify($id){
        $data = DB::table('users')
        ->where('id', $id)
        ->update(['verifiedByAdmin' => "1"]);

        return redirect('master-apps/form-user');
    }
    public function edit($id)
    {
        $roles = new role;
        $roles = $roles->all();
        $edit = new userAccess;
        $edit = $edit->find($id);//DB::table('users')->where('id', $id)->get();
        $output = [$edit,$roles];
        return $output;//view('masterApps.mobile.superAdmin.addUser', ['d' => $edit]);
    }
    public function save(Request $request){
        $save = new role();
        $save->role = $request->role;
        $save->status = $request->status;
        $save->save();
        return redirect('master-apps/form-roles')->with(['flash' => "Data ditambahkan"]);
    }
    public function update(Request $request){

        if($request->loginstatus == 1){
            DB::table('users')->where('id', $request->id)->update([
                'email' => $request->email,
                'status' => $request->loginstatus,
                'rolesId' => $request->rolesId,
                'passwordWrong' => "0",
            ]);
        } else{
            DB::table('users')->where('id', $request->id)->update([
                'email' => $request->email,
                'status' => $request->loginstatus,
                'rolesId' => $request->rolesId,
            ]);
        }

        
        return redirect('master-apps/form-user')->with(['flash' => 'Data Berhasil diupdate']);
    }
    public function updateRoles(Request $request){
        DB::table('roles')->where('id', $request->id)->update([
            'role' => $request->role,
            'status' => $request->status,
        ]);
        return redirect('master-apps/form-roles')->with(['flash' => 'Data Berhasil diupdate']);
    }
    public function editRoles($id){
        $roles = new role;
        $roles = $roles->all();
        $edit = $roles->find($id);//DB::table('users')->where('id', $id)->get();
        $output = [$edit,$roles];
        return $output;
    }
    public function dataMenu(Request $request){
        if($request->id){
            DB::table('menus')->where('id', $request->id)->update([
                'parent_id' => $request->parent,
                'menu' => $request->menu,
                'icon' => $request->icon,
                'link' => $request->link,
                'status' => $request->status,
                'aplikasi_id' => $request->aplikasi,
                'posisi' => $request->urutan,
            ]);
        }else{
            DB::table('menus')->insert([
                'parent_id' => $request->parent,
                'menu' => $request->menu,
                'icon' => $request->icon,
                'link' => $request->link,
                'status' => $request->status,
                'aplikasi_id' => $request->aplikasi,
                'posisi' => $request->urutan
            ]);

        }
        return redirect('master-apps/form-menu');
    }
    public function editMenu($id){
        $edit = DB::table('menus')->where('id', $id)->get();
        $editMenu = DB::table('menus')->get();
        $editIcon = DB::table('icons')->get();
        $aplikasi = aplikasi::all();
        $output = [$edit, $editIcon, $editMenu, $aplikasi];
        return $output;
    }
    public function dataHakAkses($id){
        $dataHakAkses = DB::table('v_hak_akses')->where('user_id', $id)->get();
        $table = "";
        $i =0;
        foreach($dataHakAkses as $data)
        {
            $table.='</tr>';
            $i++;
        }
        return $dataHakAkses;
    }
    public function updateHakAkses($id, $isinya, $apa, $idUser)
    {
        if($isinya == '1')
        {
            if($apa != "lihat"){
                $cektipe = hakAkses::where('id', $id)->first();
                if($cektipe->$apa == "0"){
                    hakAksesAplikasi::where('menu_id', $id)->update([
                        "lihat" => "1", 
                    ]);
                }
                // if ubah jadi aktif
                $hakAkses   =  new hakAkses;
                $hakAkses   = $hakAkses->find($id);

                $menus      = new Menu;
                $menus       = $menus->where('menu',$hakAkses->menu)->first();

                if($menus->parent_id != '0')
                {
                    $cekparent = hakAksesAplikasi::where('menu_id',$menus->parent_id)->where('user_id',$idUser)->first();
                    if ($cekparent->lihat == '0') 
                    {
                        hakAksesAplikasi::where('menu_id', $cekparent->id)->update([
                            'lihat' => "1",
                        ]);
                        hakAksesAplikasi::where('menu_id', $id)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }else{
                        hakAksesAplikasi::where('menu_id', $id)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }
                }
                else
                {
                    hakAksesAplikasi::where('menu_id', $id)->update([
                        $apa => $isinya,
                    ]);
                    return $id;              
                }
            }else{
                // if ubah jadi aktif
                $hakAkses   =  new hakAkses;
                $hakAkses   = $hakAkses->find($id);

                $menus      = new Menu;
                $menus       = $menus->where('menu',$hakAkses->menu)->first();

                if($menus->parent_id != '0')
                {
                    $cekparent = hakAksesAplikasi::where('menu_id',$menus->parent_id)->where('user_id',$idUser)->first();
                    if ($cekparent->lihat == '0') 
                    {
                        hakAksesAplikasi::where('menu_id', $cekparent->id)->update([
                            'lihat' => "1",
                        ]);
                        hakAksesAplikasi::where('menu_id', $id)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }else{
                        hakAksesAplikasi::where('menu_id', $id)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }
                }
                else
                {
                    hakAksesAplikasi::where('menu_id', $id)->update([
                        $apa => $isinya,
                    ]);
                    return $id;              
                }
            }
        }
        else
        {
            $hakAkses   =  new hakAkses;
            $hakAkses   = $hakAkses->find($id);
            $menu1 = Menu::where('menu', $hakAkses->menu)->first();
            $menu = Menu::where('parent_id', $menu1->id)->get();

            $tampung = 0;
            foreach ($menu as $m) {
                $cekchild = hakAksesAplikasi::where('menu_id', $m->id)->first();
                if($cekchild['lihat'] == "1"){
                    $tampung++;
                }else{
                    
                }
            }
            if($tampung > 0){
                hakAksesAplikasi::where('menu_id', $id)->update([
                    $apa => $isinya,
                ]);
                foreach ($menu as $m) {
                    hakAksesAplikasi::where('menu_id', $m->id)->update([
                        'lihat' => "0",
                    ]);
                }
                return $id;  
            }else{
                hakAksesAplikasi::where('menu_id', $id)->update([
                    $apa => $isinya,
                ]);
                return $id;  
            }
        }
    }
} 
