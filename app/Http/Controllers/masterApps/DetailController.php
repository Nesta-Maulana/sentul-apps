<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\Kategoribd;
use App\Models\masterApps\Detail;   
use App\Models\masterApps\karyawan;
use DB;
use Session;

class DetailController extends Controller
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
        $show = Detail::all();
        $username = $this->username;
        $menus = $this->menu;
        return view('masterApps.detail-bd', compact('tampil', 'show', 'username', 'menus'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_bd' => 'required',
            'detail' => 'required'
        ]);


        $kategoribd = Detail::create([
            'kategori_bd_id' => $request->kategori_bd,
            'detail' => $request->detail
        ]); 
        

        return redirect()->route('detail.index')->with('message', 'Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tampil = Kategoribd::all();
        $show = Detail::all();
        $aksi = Detail::findOrFail($id);
        return view('masterApps.detail-bd', compact('show', 'aksi', 'tampil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tampil = Kategoribd::all();
        $data = $request->all();
        $updateField['kategori_bd_id'] = $data['kategori_bd_id  '];
        $updateField['detail'] = $data['detail'];


        $update = Detail::where('id', $request->id )->update($updateField);

        return redirect()->route('detail.index')->with('message', 'Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
