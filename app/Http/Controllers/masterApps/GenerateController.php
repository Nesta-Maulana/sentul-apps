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
    
    public function index()
    {
        $formhead = formHead::all();
        $head = formHead::with('formDetail')->get();
        $formdetail = formDetail::all();
        return view('masterApps.form-generate', compact('formhead', 'head','formdetail'));
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
