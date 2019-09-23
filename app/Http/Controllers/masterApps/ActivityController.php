<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\Activity;
use App\Models\masterApps\Kategoribd;
use App\Models\masterApps\karyawan;
use DB;
use Session;
class ActivityController extends Controller
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
        $show = Activity::all();
        $username = $this->username;
        $menus = $this->menu;
        return view('masterApps.activity', compact('show', 'username', 'menus'));
    }

    public function create()
    {
        
    }


    public function store(Request $request)
    {
        Activity::create([
            'activity' => $request->activity,
            'status' => $request->status
        ]);

        return redirect()->route('activity.index')->with('message', 'Berhasil di Simpan');
    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $show = Activity::all();
        $aksi = Activity::findOrFail($id);
        return view('masterApps.activity', compact('show', 'aksi'));
    }

    public function update($id, Request $request)
    {
        $show = Activity::findOrFail($id);

        $data = $request->all();
        $updateField['activity'] = $data['activity'];
        $updateField['status'] = $data['status'];
        $update = Activity::where('id', $id)->update($updateField);

        return redirect()->route('activity.index')->with('message', 'Berhasil di Update');
    }

    public function destroy($id)
    {
        $show = Activity::findOrFail($id);

        $show->delete();

        return redirect()->route('activity.index');
    }
}