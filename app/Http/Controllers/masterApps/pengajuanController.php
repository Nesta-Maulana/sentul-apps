<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\Pengajuan;
use App\Imports\formImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;




class pengajuanController extends Controller
{
    public function download(){

        $file = '';

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, '' , $headers);
    }

    public function approve(){
        $tampil = Pengajuan::all();
        return view('masterApps.approval', compact('tampil'));
    }

    public function tampil(){
        $show = Pengajuan::all();
        return view('masterApps.dashboard', compact('show'));
    }

    public function index()
    {
        return view ('masterApps.pengajuan');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        // return $request->all();
        $filejadwal     = $request->file('file_attachment');
        $uploadjadwal   = Excel::import( new formImport, $filejadwal);

        $pengajuan = Pengajuan::create( $request->all());


        return redirect()->route('pengajuan', compact('pengajuan'));
    }

   
    public function show($id)
    {
        
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
        //
    }
}


