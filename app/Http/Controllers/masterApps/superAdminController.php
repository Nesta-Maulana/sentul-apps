<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\plan;
use App\Models\masterApps\jenisProduk;
use App\Models\masterApps\produk;
use App\Models\masterApps\brand;
use App\Models\masterApps\mesinFilling;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\company;
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use App\Models\utilityOnline\kategoriPencatatan;
use App\Models\utilityOnline\satuan;
use Session;
use DB;

class superAdminController extends resourceController
{
    private $menu;
    private $username;

    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            // dd(Session::all());

            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            $this->username =  $this->username->fullname;
            $this->menu = DB::table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'Master Apps')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

    public function index(){
        
        $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->get();
        $hakAksesAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->count();
        if($hakAksesAplikasi == "1"){
            $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->first();
            $aplikasi = aplikasi::find($hakAksesUserAplikasi->id_aplikasi)->first();
            return redirect($aplikasi->link);
        }
        $i = 0;
        foreach ($hakAksesUserAplikasi as $h) {
            $data[$i] = DB::table('aplikasi')->where('id', $h->id_aplikasi)->first();
            $i++;
        }
        return view('userAccess.home', ['menus' => $this->menu, 'username' => $this->username, 'hakAkses' => $data]);
    }

    public function home(){
        return view('masterApps.home', ['menus' => $this->menu, 'username' => $this->username]);
    }

    public function menu(Request $request){
        $aplikasi = aplikasi::get();
        $icons = DB::table('icons')->get();
        $parents = DB::table('menus')->where('parent_id', '0')->get();
        $allMenu = DB::table('menus')->orderBy('parent_id', 'asc')->get();
        return view('masterApps.formMenu', ['icons' => $icons, 'menus' => $this->menu, 'parents' => $parents, 'allMenu' => $allMenu, 'username' => $this->username, 'aplikasi' => $aplikasi]);
    }
    public function urutan($id){
        $urutan = DB::table('menus')->where('parent_id', $id)->orderBy('posisi', 'asc')->get();
        return $urutan;
    } 
    public function pmb(){
        return view('masterApps.formPmb', ['menus' => $this->menu, 'username' => $this->username]);
    }
    public function user(){
        $users = new userAccess;
        $user = $users->where('rolesId', '!=', '1')->get();
        $countUnverify = DB::table('users')->where('verifiedByAdmin', '0')->count();
        $countLogin = $users::where('status', '=', '1')->count();
        $countVerify = DB::table('users')->where('verifiedByAdmin', '1')->count();

        return view('masterApps.formUser', ['user' => $user, 'countUnverify' => $countUnverify, 
        'countVerify' => $countVerify, 'countLogin' => $countLogin, 'menus' => $this->menu, 'username' => $this->username]);
    } 

    public function brand(){
        $brands = brand::all();
        $plan = plan::all();
        return view('masterApps.formbrand', ['menus' => $this->menu, 'username' => $this->username, 'brands' => $brands, 'plans' => $plan]);
    }

    public function editBrand($id){
        return brand::find($id);
    }

    public function dataBrand(Request $request){
        brand::create([
            'brand' => $request->brand,
            'plan_id' => $request->plan
        ]);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }


    public function plan(){
        $company = company::all();
        $plan = plan::all();
        return view('masterApps.plan', ['menus' => $this->menu, 'username' => $this->username, 'companies' => $company, 'plans' => $plan]);
    }

    public function dataPlan(Request $request){
        plan::create([
            'plan' => $request->plan,
            'company_id' => $request->company,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);
        return back()->with('success', 'Berhasil Menambahkan');
    }

    public function jenisProduk(){
        return view('masterApps.plan', ['menus' => $this->menu, 'username' => $this->username]);
    }

    public function hakAkses(){
        $hakAkses = hakAkses::all();
        $user = userAccess::all();
        $karyawan = karyawan::all();
        return view('masterApps.formHakAkses', ['menus' => $this->menu, 'hakAkses' => $hakAkses, 'users' => $user, 'username' => $this->username, 'karyawan' => $karyawan]);
    }

    public function produk(){
        return view('masterApps.produk', ['menus' => $this->menu, 'username' => $this->username]);
    }

    public function mesinFilling(){
        $mesinFilling = mesinFilling::all();
        return view('masterApps.mesinFilling', ['menus' => $this->menu, 'username' => $this->username, 'mesinFilling' => $mesinFilling]);
    }

    public function dataMesinFilling(Request $request){
        mesinFilling::create([
            'nama_mesin' => $request->mesin,
            'kode_mesin' => $request->kodeMesin
        ]);
        return back()->with('success', 'Berhasil Ditambahkan');
    }

    public function rasio(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        $company = company::all();
        return view('masterApps.rasio', ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter, 'bagian' => $bagian, 'company' => $company]);
    }
    public function satuan(){
        $satuan = satuan::all();
        return view('masterApps.satuan', ['menus' => $this->menu, 'username' => $this->username, 'satuan' => $satuan]);
    }
    public function editSatuan($id){
        $editSatuan = satuan::find($id);
        return $editSatuan;
    }
    public function dataSatuan(Request $request){
        if($request->id){
            $satuan = satuan::find($request->id);
            $satuan->satuan = $request->satuan;
            $satuan->status = $request->status;
            $satuan->save();
            return redirect('master-apps/satuan')->with('success', 'Data Berhasil DiUpdate');
        }else{
           satuan::create([
               'satuan' => $request->satuan,
               'status' => $request->status,
           ]);
           return redirect('master-apps/satuan')->with('success', 'Data Berhasil ditambahkan');
        }
    }
    public function rasioWorkcenter($id){
        $workcenter = workcenter::where('kategori_id', $id)->get();
        return $workcenter;
    }
    public function rasioBagian($id){
        $bagian = bagian::where('workcenter_id', $id)->get();
        return $bagian;
    }
    public function rasioHeadSave(Request $request){
        rasioHead::create([
            'bagian_id' => $request->bagian,
            'status' => '1'
        ]);
        $rasio = rasioHead::latest()->first();
        return $rasio;
    }
    public function rasioSave(Request $request){

        
        $messages = [
            'between' => 'Input rasio minimal 0 dan maksimal 100',
        ];
         
        $this->validate($request,[
            'rasio' => 'integer|between:0,100',
        ],$messages);

        rasio::create([
            'rasio_head_id' => $request->id,
            'company_id' => $request->company,
            'nilai' => $request->rasio
        ]);
        return redirect('master-apps/rasio')->with('success', 'Data Berhasil Ditambahkan');
    }
    public function roles(){
        $roles = new role();
        $roles = $roles->all();
        // foreach ($roles as $r ) {
        //     $user = $r->user;
        // }
        // foreach ($roles as $role) 
        // {
        //     foreach ($role->user as $value) 
        //     {
        //         echo $value->username;
        //     }
        // }
        $roles2 = $roles->count();
        for($i = 1; $i <= $roles2; $i++){
            $cek[$i] = DB::table('users')->where('rolesId', $i)->count();
        }
        return view('masterApps.formroles', ['roles' => $roles], ['users' => $cek, 'menus' => $this->menu, 'username' => $this->username]);
    }
    public function company(){
        $company = company::all();
        return view("masterApps.company", ['menus' => $this->menu, 'username' => $this->username, 'company' => $company]);
    }
    public function kategori(){
        $kategori = kategori::all();
        return view("masterApps.kategori", ['kategori' => $kategori, 'menus' => $this->menu, 'username' => $this->username]);
    }
    public function workcenter(){
        $kategori = kategori::all();
        $workcenter = workcenter::all();
        return view("masterApps.workcenter", ['menus' => $this->menu, 'username' => $this->username, 'kategori' => $kategori, 'workcenter' => $workcenter]);
    }
    public function bagian(){
        $workcenter = workcenter::all();
        $bagian = bagian::all();
        $satuan = satuan::all();
        $kategoriPencatatan = kategoriPencatatan::all();
        return view("masterApps.bagian", ['menus' => $this->menu, 'username' => $this->username, 'workcenter' => $workcenter, 'bagian' => $bagian, 'satuan' => $satuan, 'kategoriPencatatan' => $kategoriPencatatan]);
    }
    public function dataBagian(Request $request){
        if($request->id){
            $bagian = bagian::find($request->id);
            $bagian->workcenter_id = $request->workcenter;
            $bagian->status = $request->status;
            $bagian->kategori_pencatatan_id = $request->kategori_pencatatan;
            $bagian->bagian = $request->bagian;
            $bagian->satuan_id = $request->satuan;
            $bagian->spek_min = $request->spek_min;
            $bagian->spek_max = $request->spek_max;
            $bagian->save();
            return redirect('master-apps/bagian')->with('success', 'Data Berhasil DiUpdate');
        }else{
           bagian::create([
               'workcenter_id' => $request->workcenter,
               'kategori_pencatatan_id' => $request->kategori_pencatatan,
               'status' => $request->status,
               'bagian' => $request->bagian,
               'satuan_id' => $request->satuan,
               'spek_min' => $request->spek_min,
               'spek_max' => $request->spek_max,
           ]);
           return redirect('master-apps/bagian')->with('success', 'Data Berhasil ditambahkan');
        }
    }
    public function dataKategori(Request $request){
        if($request->id){
            $kategori = kategori::find($request->id);
            $kategori->kategori = $request->kategori;
            $kategori->save();
            return redirect('master-apps/kategori')->with('success', 'Data Berhasil DiUpdate');
        }else{
            kategori::create([
                'kategori' => $request->kategori
            ]);
            return redirect('master-apps/kategori')->with('success', 'Data Berhasil Ditambahkan');
        }
    }
    public function dataWorkcenter(Request $request){
        if($request->id){
            $workcenter = workcenter::find($request->id);
            $workcenter->workcenter = $request->workcenter;
            $workcenter->kategori_id = $request->kategori;
            $workcenter->status = $request->status;
            $workcenter->save();
            return redirect('master-apps/workcenter')->with('success', 'Data Berhasil DiUpdate');
        }else{
            workcenter::create([
                'workcenter' => $request->workcenter,
                'status' => $request->status,
                'kategori_id' => $request->kategori
            ]);
            return redirect('master-apps/workcenter')->with('success', 'Data Berhasil Ditambahkan');
        }
    }
    public function dataCompany(Request $request){
        if($request->id){
            $company = company::find($request->id);
            $company->company = $request->company;
            $company->singkatan = $request->singkatan;
            $company->status = $request->status;
            $company->save();
            return redirect('master-apps/company')->with('success', 'Data Berhasil DiUpdate');
        }else{
            company::create([
                'company' => $request->company,
                'singkatan' => $request->singkatan,
                'status' => $request->status
            ]);
            return redirect('master-apps/company')->with('success', 'Data Berhasil Ditambahkan');
        }
    }
    public function editKategori($id){
        $editKategori = kategori::find($id);
        return $editKategori;
    }
    public function editWorkcenter($id){
        $editWorkcenter = workcenter::find($id);
        $kategori = kategori::all();
        $output = [$editWorkcenter, $kategori];
        return $output;
    }
    public function editBagian($id){
        $editBagian = bagian::find($id);
        $workcenter = workcenter::all();
        $kategoriPencatatan = kategoriPencatatan::all();
        $satuan = satuan::all();
        $output = [$editBagian, $workcenter, $kategoriPencatatan, $satuan];
        return $output;
    }
    public function editCompany($id){
        $company = company::find($id);
        return $company;
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
        $nik = $edit->username;
        $karyawan = karyawan::where('nik', $nik)->first();
        
        $output = [$edit,$roles, $karyawan];
        return $output;//view('masterApps.addUser', ['d' => $edit]);
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
                'status' => $request->loginstatus,
                'rolesId' => $request->rolesId,
                'passwordWrong' => "0",
            ]);
            $karyawan = karyawan::where('nik', $request->nik);
            $karyawan->update([
                'email' => $request->email,
            ]);
        } else{
            DB::table('users')->where('id', $request->id)->update([
                
                'status' => $request->loginstatus,
                'rolesId' => $request->rolesId,
            ]);
            $karyawan = karyawan::where('nik', $request->nik);
            $karyawan::update([
                'email' => $request->email,
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
            $menu = DB::table('menus')
                ->latest()
                ->first();
            $menu = menu::Create([
                'parent_id' => $request->parent,
                'menu' => $request->menu,
                'icon' => $request->icon,
                'link' => $request->link,
                'aplikasi_id' => $request->aplikasi,
                'status' => $request->status,
                'posisi' => $request->urutan
            ]);
            $user = userAccess::all();
            foreach ($user as $value) 
            {
                $cekakses = DB::table('hak_akses_menu')->select('*')->where('user_id',$value->id)->where('menu_id',$menu->id)->count();
                if($cekakses == 0)
                {
                     hakAksesAplikasi::create([
                        'user_id' =>$value->id,
                        'menu_id' => $menu->id,
                        'lihat' => '0',
                        'tambah' => '0',
                        'ubah' => '0',
                        'hapus' => '0',
                     ]);
                }
            }
            // DB::table('menus')->insert([
            //     'parent_id' => $request->parent,
            //     'menu' => $request->menu,
            //     'icon' => $request->icon,
            //     'link' => $request->link,
            //     'aplikasi_id' => $request->aplikasi,
            //     'status' => $request->status,
            //     'posisi' => $request->urutan
            // ]);
            // SELECT * FROM menus ORDER BY id DESC LIMIT 1
            
        }
        return redirect('master-apps/form-menu');
    }
    public function editMenu($id, $aplikasi){
        $edit = DB::table('menus')->where('id', $id)->get();
        $editMenu = DB::table('menus')->where('aplikasi_id', $aplikasi)->get();
        $editIcon = DB::table('icons')->get();
        $aplikasi = aplikasi::all();
        $output = [$edit, $editIcon, $editMenu, $aplikasi];
        return $output;
    }
    public function parent($parent){
        $parents = menu::where('aplikasi_id', $parent)->get();
        foreach ($parents as $p ) {
            $cek = menu::where('parent_id', $p->id)->count();
            if ($cek > 0 ) {
                $cek2 = menu::where('parent_id', $p->id)->get();
                
                foreach ($cek2 as $c ) {
                    foreach ($parents as $p ) {
                        if ($c->menu == $p->menu) {
                            $p->where('menu', $c->menu)->delete();
                        }
                    }
                }
            }
        }
        return $parents;

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
                    hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
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
                        hakAksesAplikasi::where('menu_id', $cekparent->id)->where('user_id', $idUser)->update([
                            'lihat' => "1",
                        ]);
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }else{
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }
                }
                else
                {
                    hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
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
                        hakAksesAplikasi::where('menu_id', $cekparent->id)->where('user_id', $idUser)->update([
                            'lihat' => "1",
                        ]);
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }else{
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $apa => $isinya,
                        ]);
                        return $id;
                    }
                }
                else
                {
                    hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
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
                hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                    $apa => $isinya,
                ]);
                foreach ($menu as $m) {
                    hakAksesAplikasi::where('menu_id', $m->id)->where('user_id', $idUser)->update([
                        'lihat' => "0",
                    ]);
                }
                return $id;  
            }else{
                hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                    $apa => $isinya,
                ]);
                return $id;  
            }
        }
    }
}
