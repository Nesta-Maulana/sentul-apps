<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\formHead;
use App\Models\masterApps\formDetail;
use App\Models\masterApps\PengamatanDetail;
use App\Models\masterApps\PengamatanHead;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\Kategoribd;

use DB;
use Session;

class GenerateController extends Controller
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
        $formhead = formHead::all();
        $head = formHead::with('formDetail')->get();
        $username = $this->username;
        $menus = $this->menu;
        $formdetail = formDetail::all();
        return view('masterApps.form-generate', compact('formhead', 'head','username', 'menus', 'formdetail'));
    }


    public function cekwo($id){
        $form_head = formHead::findOrFail($id);

        foreach($form_head->formDetail as $key=>$value)
        {

        }
        return $form_head;
        return response()->json([
            'form_head'=> $form_head
        ]);
    }

    public function generate($id){
        $parameter = formDetail::findOrFail($id);
        
        return response()->json([
            'parameter'=>$parameter
        ]);
    }



    public function create()
    {
        
    }


    public function store(Request $request)
    {
        // return $request->all();

        $pengamatan_head = PengamatanHead::create([
            'form_head_id'=> $request->nama,
            'tanggal_pengamatan'=>date('Y-m-d'),
            'no_wo'=>$request->request_nowo,
        ]);
        
        

        $pengamatan_detail = PengamatanDetail::create([
            'form_detail_id'=>$request->nama,
            'result'=>'OK',
            
        ]);

        
            
        return redirect()->route('form.store');
    }

     
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        
    }
}
