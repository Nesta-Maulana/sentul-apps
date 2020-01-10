<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\exports\formExport;
use App\Models\masterApps\formHead;
use App\Models\masterApps\formDetail;
use App\Models\masterApps\Upload;
use App\Imports\formImport;

class FormController extends Controller
{

    /**
     * Display a listing of the resource.
     *controller a
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form = Upload::all();
        $head = formHead::all();
        $detail = formDetail::all();
        return view('masterApps.form-verifikasi', compact('form', 'head', 'detail'));
    }

    public function export_excel(){
        return Excel::download(new formExport, 'template_verifikasi.xlsx');
    }

    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
        $filejadwal     = $request->file('file');
        $uploadjadwal   =   Excel::import(new formImport, $filejadwal);
		// alihkan halaman kembali
		return redirect('/form');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
