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
use App\Models\masterApps\requestHakAplikasi;
use App\Models\masterApps\requestHakAplikasiHead;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\plan;
use App\Models\masterApps\jenisProduk;
use App\Models\masterApps\produk;
use App\Models\masterApps\brand;
use App\Models\masterApps\subBrand;
use App\Models\masterApps\mesinFilling;
use App\Models\masterApps\mesinFillingHead;
use App\Models\masterApps\mesinFillingDetail;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\company;
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use App\Models\utilityOnline\kategoriPencatatan;
use App\Models\utilityOnline\satuan;
use App\Mail\userAccess\activateUser;
use Illuminate\Support\Facades\Mail;


use Session;
use DB;

class superAdminController extends resourceController
{ 
    private $menu;
    private $username;

    public function __construct(Request $request){
        $this->middleware(function ($request, $next)
        {
            $this->user = resolve('usersData');
            $this->username = karyawan::where('nik', $this->user->username)->first();            
            $this->username =  $this->username->fullname;
            $this->menu = DB::connection('master_apps')->table('v_hak_akses')->where('user_id',Session::get('login'))
            ->where('parent_id', '0')
            ->where('lihat', '1')
            ->where('aplikasi', 'Master Apps')
            ->orderBy('posisi', 'asc')
            ->get();
            
            return $next($request);
        });
    }

    public function index()
    {
        $hakAksesUserAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->get();
        $hakAksesAplikasi = hakAksesUserAplikasi::where('id_user', Session::get('login'))->where('status', '1')->count();
        if($hakAksesAplikasi == "0"){
            return view('userAccess.home', ['hakAkses' => null]);
        }
        $i = 0; 
        foreach ($hakAksesUserAplikasi as $h) {
            $data[$i] = DB::connection('master_apps')->table('aplikasi')->where('id', $h->id_aplikasi)->first();
            $i++;
        }
        return view('userAccess.home', ['hakAkses' => $data]);
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

    public function brand()
    {
        $brands = brand::all();
        $company = company::all();
        return view('masterApps.formbrand', ['menus' => $this->menu, 'username' => $this->username, 'brands' => $brands, 'company' => $company]);
    }

    public function editBrand($id)
    {
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $company = company::all();
        return [brand::find($id), $company];
    }

    public function dataBrand(Request $request){
        if ($request->id) {
            $brand = brand::find($request->id);
            $brand->brand = $request->brand;
            $brand->company_id = $request->company;
            $brand->save();
        }else{
            brand::create([
                'brand' => $request->brand,
                'company_id' => $request->company
            ]);
        }
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }


    public function plan(){
        $company = company::all();
        $plan = plan::all();
        return view('masterApps.plan', ['menus' => $this->menu, 'username' => $this->username, 'companies' => $company, 'plans' => $plan]);
    }

    public function editPlan($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $editPlan = plan::find($id);
        $companies = company::all();
        return [$editPlan, $companies];
    }

    public function dataPlan(Request $request){
        if ($request->id) 
        {
            $plan       = plan::find($request->id);
            $plan->plan = $request->plan; 
            $plan->company_id = $request->company; 
            $plan->alamat = $request->alamat; 
            $plan->status = $request->status; 
            $plan->save();
        }
        else
        {
            $plan = plan::create([
                'plan' => $request->plan,
                'company_id' => $request->company,
                'alamat' => $request->alamat,
                'status' => $request->status,
            ]);
            if ($plan) 
            {    
                return back()->with('success', 'Berhasil Menambahkan');
            }
            else
            {
                return back()->with('error', 'Berhasil Menambahkan');
            }
        }
    }

    public function jenisProduk(){
        $products = jenisProduk::all();
        return view('masterApps.jenisProduk', ['menus' => $this->menu, 'username' => $this->username, 'products' => $products]);
    }

    public function editJenisProduk($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        return jenisProduk::find($id);
    }

    public function dataJenisProduk(Request $request){
        if($request->id){
            $jenisProduk = jenisProduk::find($request->id);
            $jenisProduk->jenis_produk = $request->jenisProduk;
            $jenisProduk->save();
        }else{
            jenisProduk::create([
                'jenis_produk' => $request->jenisProduk
            ]);
        }
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function hakAkses(){
        $hakAkses = hakAkses::all();
        $user = userAccess::all();
        $karyawan = karyawan::all();
        return view('masterApps.formHakAkses', ['menus' => $this->menu, 'hakAkses' => $hakAkses, 'users' => $user, 'username' => $this->username, 'karyawan' => $karyawan]);
    }

    public function verifyRequest(){
        $requestHakAplikasiHead = requestHakAplikasiHead::all();
        $requestHakAplikasi = requestHakAplikasi::all();
        $menus = menu::all();
        $users = userAccess::all();
        $aplications = aplikasi::all();
        
        return view('masterApps.verifyRequest', ['aplications' => $aplications, 'allMenu' => $menus, 'users' => $users,'menus' => $this->menu, 'username' => $this->username, 'requestHakAplikasiHead' => $requestHakAplikasiHead, 'requestHakAplikasi' => $requestHakAplikasi]);
    }

    public function verifyRequestAplikasi($id){
        $requestHakAplikasiHead = requestHakAplikasiHead::all();
        $users = userAccess::all();
        $aplications = aplikasi::all();
        // DISiNI
        $requestHakAplikasi = requestHakAplikasi::join('request_hak_app_head', 'request_hak_app.id_request_head', 'request_hak_app_head.id')
                                                ->where('request_hak_app_head.id_aplikasi', $id)
                                                ->select('request_hak_app.*', 'request_hak_app_head.id_aplikasi', 'request_hak_app_head.id_user_request')
                                                ->get();                    
        foreach ($requestHakAplikasi as $rh ) {
            $rh->menu = $rh->menu->menu;
            foreach ($users as $user ) {
                if($user->id == $rh->id_user_request){
                    $rh->user = $user->karyawan->fullname;
                }
            }
            foreach ($aplications as $aplication ) {
                
                if($rh->id_aplikasi == $aplication->id)
                {
                    $rh->aplikasi = $aplication->aplikasi;
                }
            }
        }
        return $requestHakAplikasi;
    }

    public function verifyRequestUser($id){
        $requestHakAplikasiHead = requestHakAplikasiHead::all();
        $users = userAccess::find($id);
        $aplications = aplikasi::all();
        // DISiNI
        $requestHakAplikasi = requestHakAplikasi::join('request_hak_app_head', 'request_hak_app.id_request_head', 'request_hak_app_head.id')
                                                ->where('request_hak_app_head.id_user_request', $id)
                                                ->select('request_hak_app.*', 'request_hak_app_head.id_aplikasi', 'request_hak_app_head.id_user_request')
                                                ->get();                    
        foreach ($requestHakAplikasi as $rh ) {
            $rh->menu = $rh->menu->menu;
            if($users->id == $rh->id_user_request){
                $rh->user = $users->karyawan->fullname;
            }
            
            foreach ($aplications as $aplication ) {
                
                if($rh->id_aplikasi == $aplication->id)
                {
                    $rh->aplikasi = $aplication->aplikasi;
                }
            }
        }
        return $requestHakAplikasi;
    }

    public function verifyRequestAksi($id){
        $requestHakAplikasiHead = requestHakAplikasiHead::all();
        $users = userAccess::all();
        $aplications = aplikasi::all();
        // DISiNI
        $requestHakAplikasi = requestHakAplikasi::join('request_hak_app_head', 'request_hak_app.id_request_head', 'request_hak_app_head.id')
                                                ->where('request_hak_app.aksi', $id)
                                                ->select('request_hak_app.*', 'request_hak_app_head.id_aplikasi', 'request_hak_app_head.id_user_request')
                                                ->get();                    
        foreach ($requestHakAplikasi as $rh ) {
            $rh->menu = $rh->menu->menu;
            foreach ($users as $user ) {
                if($user->id == $rh->id_user_request){
                    $rh->user = $user->karyawan->fullname;
                }
            }
            foreach ($aplications as $aplication ) {
                
                if($rh->id_aplikasi == $aplication->id)
                {
                    $rh->aplikasi = $aplication->aplikasi;
                }
            }
        }
        return $requestHakAplikasi;
    }

    public function verifyRequestMenu($id){
        $requestHakAplikasiHead = requestHakAplikasiHead::all();
        $users = userAccess::all();
        $aplications = aplikasi::all();
        // DISiNI
        $requestHakAplikasi = requestHakAplikasi::join('request_hak_app_head', 'request_hak_app.id_request_head', 'request_hak_app_head.id')
                                                ->where('request_hak_app.id_menu', $id)
                                                ->select('request_hak_app.*', 'request_hak_app_head.id_aplikasi', 'request_hak_app_head.id_user_request')
                                                ->get();                    
        foreach ($requestHakAplikasi as $rh ) {
            $rh->menu = $rh->menu->menu;
            foreach ($users as $user ) {
                if($user->id == $rh->id_user_request){
                    $rh->user = $user->karyawan->fullname;
                }
            }
            foreach ($aplications as $aplication ) {
                
                if($rh->id_aplikasi == $aplication->id)
                {
                    $rh->aplikasi = $aplication->aplikasi;
                }
            }
        }
        return $requestHakAplikasi;
    }

    public function aplikasi(){
        $aplikasi = aplikasi::all();
        return view('masterApps.aplikasi', ['menus' => $this->menu, 'username' => $this->username, 'aplikasi' => $aplikasi]);
    }

    public function editAplikasi($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        return aplikasi::find($id);
    }

    public function saveAplikasi(Request $request){
        if($request->id){
            $aplikasi = aplikasi::find($request->id);
            $aplikasi->aplikasi = $request->aplikasi;
            $aplikasi->status = $request->status;
            $aplikasi->link = $request->link;
            $aplikasi->save();
            return back()->with('success','Berhasil Mengubah');
        }else{
            $aplikasi = aplikasi::create([
                'aplikasi' => $request->aplikasi,
                'status' => $request->status,
                'link' => $request->link
            ]);
            $user = userAccess::all();
            foreach ($user as $value) 
            {
                $cekakses = hakAksesUserAplikasi::select('*')->where('id_user',$value->id)->where('id_aplikasi',$aplikasi->id)->count();
                if($cekakses == 0)
                {
                     hakAksesUserAplikasi::create([
                        'id_user' =>$value->id,
                        'id_aplikasi' => $aplikasi->id,
                        'status' => '0',
                     ]);
                }
            }
            return back()->with('success','Berhasil Menambahkan');
        }
    }

    public function hakAksesAplikasi(){
        $hakAksesAplikasi = hakAksesUserAplikasi::all();
        $users = userAccess::all();
        return view('masterApps.hakAksesAplikasi', ['menus' => $this->menu, 'username' => $this->username, 'hakAksesAplikasi' => $hakAksesAplikasi, 'users' => $users]);
    }

    public function showHakAksesAplikasi($id){
        $edit = hakAksesUserAplikasi::where('id_user',$id)->get();
        return [$edit, aplikasi::all(), karyawan::all()];
    }
    
    public function ubahHakAksesAplikasi($id, $aksi){
        $hakAksesUserAplikasi = hakAksesUserAplikasi::find($id);
        $hakAksesUserAplikasi->status = $aksi;
        $hakAksesUserAplikasi->save();
        return ['berhasil'];
    }

    public function produk(){
        $brands = subBrand::all();
        $jenisProducts = jenisProduk::all();
        $mesinFillingHeads = mesinFillingHead::all();
        $products = produk::all();
        return view('masterApps.produk', ['menus' => $this->menu, 'username' => $this->username, 'brands' => $brands, 'jenisProducts' => $jenisProducts, 'mesinFillingHeads' => $mesinFillingHeads, 'products' => $products]);
    }
    public function editProduk($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $editProduk = produk::find($id);
        $brands = brand::all();
        $jenisProducts = jenisProduk::all();
        $mesinFillingHeads = mesinFillingHead::all();
        return [$editProduk, $brands, $jenisProducts, $mesinFillingHeads];   
    }
    public function dataProduk(Request $request){
        if(!$request->id){
            produk::create([
                'sub_brand_id' => $request->brand,
                'nama_produk' => $request->namaProduk,
                'kode_oracle' => $request->kodeOracle,
                'spek_ts_min' => $request->spekTsMin,
                'spek_ts_max' => $request->spekTsMax,
                'spek_ph_min' => $request->spekPhMin,
                'spek_ph_max' => $request->spekPhMax,
                'sla' => $request->sla,
                'kode_trial' => $request->kode_trial,
                'expired_range' => $request->expiredRange,
                'waktu_analisa_mikro' => $request->waktuAnalisaMikro,
                'kelompok_mesin_filling_head_id' => $request->kelompokMesinFillingHead,
                'jenis_produk_id' => $request->jenisProduk,
                'status' => $request->status,
            ]);
            return back()->with('success', 'Berhasil Menambahkan');
        }else{
            $produk = produk::find($request->id);
            $produk->sub_brand_id = $request->brand;
            $produk->nama_produk = $request->namaProduk;
            $produk->kode_oracle = $request->kodeOracle;
            $produk->kode_trial = $request->kodeTrial;
            $produk->spek_ts_min = $request->spekTsMin;
            $produk->spek_ts_max = $request->spekTsMax;
            $produk->spek_ph_max = $request->spekPhMax;
            $produk->spek_ph_min = $request->spekPhMin;
            $produk->sla = $request->sla;
            $produk->waktu_analisa_mikro = $request->waktuAnalisaMikro;
            $produk->kelompok_mesin_filling_head_id = $request->kelompokMesinFillingHead;
            $produk->jenis_produk_id = $request->jenisProduk;
            $produk->status = $request->status;
            $produk->save();
            return back()->with('success', 'Berhasil Mengupdate');
        }
    }

    public function mesinFilling(){
        $mesinFilling = mesinFilling::all();
        return view('masterApps.mesinFilling', ['menus' => $this->menu, 'username' => $this->username, 'mesinFilling' => $mesinFilling]);
    }

    public function editMesinFilling($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        return mesinFilling::find($id);
    }

    public function dataMesinFilling(Request $request){
        if ($request->id) {
            $mesinFilling = mesinFilling::find($request->id);
            $mesinFilling->nama_mesin = $request->mesin;
            $mesinFilling->kode_mesin = $request->kodeMesin;
            $mesinFilling->status = $request->status;
            $mesinFilling->save();
        }else{
            mesinFilling::create([
                'nama_mesin' => $request->mesin,
                'kode_mesin' => $request->kodeMesin
            ]);
        }
        return back()->with('success', 'Berhasil Ditambahkan');
    }

    public function mesinFillingHeadDetail(){
        $mesin = mesinFilling::all();
        return view('masterApps.mesinFillingHeadDetail', ['menus' => $this->menu, 'username' => $this->username, 'mesin' => $mesin]);
    }

    public function mesinFillingHeadSave(Request $request){
        
        
        $cari   = mesinFillingHead::where('nama_kelompok',$request->nama_kelompok)->select('id')->count();
        if($cari > 0)
        {
            $data = [
                'success' => false,
                'message' => 'Kelompok Mesin Filling Sudah Ada'
            ];
        }
        else
        {
            $data = [
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan'
            ];
        }

        return $data;
    }
    public function mesinFillingHeadDetailSave(Request $request)
    {
        $head = mesinFillingHead::create([
            'nama_kelompok' => $request->kelompok,
            'status' => $request->status
        ]); 
        for ($i=0; $i < count($request->company); $i++) 
        {

            mesinFillingDetail::create([
                'kelompok_mesin_filling_head_id' => $head->id,
                'mesin_filling_id' => $request->company[$i]
            ]);
        }

        return back()->with('success', 'Data Berhasil Ditambahkan');

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
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
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
        // dd($request->all());
        $messages = [
            'between' => 'Input rasio minimal 0 dan maksimal 100',
        ];
         
        $no = null;
        for ($i=0; $i < $request->jumlah; $i++) {
            $no = $no . '1';
            $this->validate($request,[
                'rasio' . $no => 'integer|between:0,100',
            ],$messages); 
            $rasio = 'rasio' . $no;
            $company = 'company' . $no;
            rasio::create([
                'rasio_head_id' => $request->id,
                'company_id' => $request->$company,
                'nilai' => $request->$rasio,
            ]);
        }

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
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $editKategori = kategori::find($id);
        return $editKategori;
    }
    public function editWorkcenter($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $editWorkcenter = workcenter::find($id);
        $kategori = kategori::all();
        $output = [$editWorkcenter, $kategori];
        return $output;
        
    }
    public function editBagian($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $editBagian = bagian::find($id);
        $workcenter = workcenter::all();
        $kategoriPencatatan = kategoriPencatatan::all();
        $satuan = satuan::all();
        $output = [$editBagian, $workcenter, $kategoriPencatatan, $satuan];
        return $output;
    }
    public function editCompany($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $company = company::find($id);
        return $company;
    }
    public function verify($id)
    {

        $user_id                = resourceController::dekripsi($id);
        $data                   = userAccess::find($user_id);
        $data->verifiedByAdmin  = "1";  
        $data->status           = "1";
        $data->save();
        Mail::to($data->karyawan->email)->send(new activateUser($data));    
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
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
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
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        $aplikasi = app('App\Http\Controllers\resourceController')->dekripsi($aplikasi);
        $edit = DB::table('menus')->where('id', $id)->get();
        $editMenu = DB::table('menus')->where('aplikasi_id', $aplikasi)->get();
        $editIcon = DB::table('icons')->get();
        $aplikasi = aplikasi::all();
        $output = [$edit, $editIcon, $editMenu, $aplikasi];
        return $output;
    }
    public function parent($aplikasi_id){
        $parents = menu::where('aplikasi_id', $aplikasi_id)->where('parent_id','0')->get();
        $menu    = array(); 
        foreach ($parents as $parent) 
        {
            array_push($menu,$parent);
            $cek2 = menu::where('parent_id', $parent->id)->get();    
            foreach ($cek2 as  $cek) 
            {
                array_push($menu,$cek);
            
            }
        }
   /*     foreach ($parents as $p ) 
        {
            $cek = menu::where('parent_id', $p->id)->count();
            if ($cek > 0 ) 
            {
                $cek2 = menu::where('parent_id', $p->id)->get();    
                foreach ($cek2 as $c ) 
                {
                    foreach ($parents as $p ) 
                    {
                        if ($c->menu == $p->menu) 
                        {
                            $p->where('menu', $c->menu)->delete();
                        }
                    }
                }
            }
        }
    */
        return $menu;

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
    public function updateHakAkses($id, $status, $aksi, $idUser)
    {
        if($status == '1')
        {
            if($aksi != "lihat")
            {
                $cektipe = hakAkses::where('id', $id)->where('user_id', $idUser)->first();
                if($cektipe->$aksi == "0"){
                    hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                        "lihat" => "1", 
                    ]);
                }
                // if ubah jadi aktif
                $hakAkses   =  new hakAkses;
                $hakAkses   = $hakAkses->find($id);

                $menus      = new Menu;
                $menus      = $menus->where('menu',$hakAkses->menu)->first();
                if($menus->parent_id != '0')
                {
                    $cekparent = hakAksesAplikasi::where('menu_id',$menus->parent_id)->where('user_id',$idUser)->first();

                    if ($cekparent->lihat == '0') 
                    {
                        hakAksesAplikasi::where('menu_id', $cekparent->id)->where('user_id', $idUser)->update([
                            'lihat' => "1",
                        ]);
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $aksi => $status,
                        ]);
                        return $id;
                    }else{
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $aksi => $status,
                        ]);
                        return $id;
                    }
                }
                else
                {
                    hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                        $aksi => $status,
                    ]);
                    return $id;              
                }
            }
            else
            {
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
                            $aksi => $status,
                        ]);
                        return $id;
                    }else{
                        hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                            $aksi => $status,
                        ]);
                        return $id;
                    }
                }
                else
                {
                    hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                        $aksi => $status,
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
                    $aksi => $status,
                ]);
                foreach ($menu as $m) {
                    hakAksesAplikasi::where('menu_id', $m->id)->where('user_id', $idUser)->update([
                        'lihat' => "0",
                    ]);
                }
                return $id;  
            }else{
                hakAksesAplikasi::where('menu_id', $id)->where('user_id', $idUser)->update([
                    $aksi => $status,
                ]);
                return $id;  
            }
        }
    }
    public function subBrand(){
        $brands = brand::all();
        $subBrands = subBrand::all();
        return view('masterApps.subBrand', ['menus' => $this->menu, 'username' => $this->username, 'brands' => $brands, 'subBrands' => $subBrands]);
    }
    public function dataSubBrand(Request $request){
        if($request->id){
            $subBrand = subBrand::find($request->id);
            $subBrand->brand_id = $request->brand;
            $subBrand->sub_brand = $request->subBrand;
            $subBrand->status = $request->status;
            $subBrand->save();
            return back()->with('success', 'Berhasil Mengubah');
        }else{
            subBrand::create([
                'brand_id' => $request->brand,
                'sub_brand' => $request->subBrand,
                'status' => $request->status,
            ]);
            return back()->with('success', 'Berhasil Menambahkan');
        }
    }
    public function editSubBrand($id){
        $id = app('App\Http\Controllers\resourceController')->dekripsi($id);
        return [subBrand::find($id), brand::all()];
    }
}
