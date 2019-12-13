<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\masterApps\Upload;

class UploadController extends Controller
{
    public function index()
    {
        $data = Upload::all();
        return view('masterApps.upload', compact('data'));
    }

    public function getDownload()
    {
        $file = "template_verifikasi.xlsx";

        $headers = array(
                'Content-Type: application/pdf',
                );

        return Response::download($file, 'template_verifikasi.xlsx', $headers);
    }

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
        // $data = new Upload;
        // $data->name = $request->input('name');
        // $file = $request->file('file');
        // $ext = $file->getClientOriginalExtension();
        // $newName = rand(100000,1001238912).".".$ext;
        // $file->move('uploads/file',$newName);
        // $data->file = $newName;
        // $data->save();
        // return redirect()->route('upload.index')->with('alert-success','Data berhasil ditambahkan!');

        // Upload::create([
        //     'name'=>$request->name,
        //     'file'=>$request->file
        // ]);
        // return redirect()->route('upload.index');
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
