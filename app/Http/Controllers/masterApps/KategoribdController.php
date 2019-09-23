<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\Kategoribd;
use App\Models\masterApps\mesinFilling;
use App\Models\masterApps\Activity;
use App\Models\MasterApps\karyawan;
use DB;
use Session;


class KategoribdController extends Controller
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
        $tampil = Kategoribd::all();
        $mesin = Kategoribd::with('mesinFilling')->get();
        $filling = mesinFilling::all();
        $list = Activity::all();
        $listactivity = Kategoribd::with('Activity')->get();
        $username = $this->username;
        $menus = $this->menu;
        return view('masterApps.kategori-bd', compact('tampil', 'mesin','filling', 'list', 'listactivity', 'username', 'menus'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_bd' => 'required',
            'status' => 'required'
        ]);

        $kategoribd = Kategoribd::create([
            'list_activity_id' => $request->list_activity_id,
            'kategori_bd' => $request->kategori_bd,
            'mesin_filling_id' => $request->mesin_filling_id,
            'status' => $request->status
        ]); 
        

        return redirect()->route('kategoribd.index');
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $filling = mesinFilling::all();
        $list = Activity::all();
        $tampil = Kategoribd::all();
        $aksi = Kategoribd::findOrFail($id);
        return view ('masterApps.kategori-bd', compact('filling', 'list', 'tampil', 'aksi'));
    }

    public function update( Request $request)
    {
        $list = Activity::all();
        $data = $request->all();
        $updateField['list_activity_id'] = $data['list_activity_id'];
        $updateField['kategori_bd'] = $data['kategori_bd'];
        $updateField['mesin_filling_id'] = $data['mesin_filling_id'];
        $updateField['status'] = $data['status'];


        $update = Kategoribd::where('id', $request->id )->update($updateField);

        return redirect()->route('kategoribd.index')->with('message', 'Berhasil di Update');
    }


    public function destroy($id)
    {
        $tampil = Kategoribd::findOrFail($id);

        $tampil->delete();

        return redirect()->route('kategoribd.index')->with('message', 'Berhasil di Hapus');
    }
}
