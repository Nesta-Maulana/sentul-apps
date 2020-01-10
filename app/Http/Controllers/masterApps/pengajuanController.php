<?php

namespace App\Http\Controllers\masterApps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\Pengajuan;
use App\Imports\formImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use File;
use App\Notifications\Email;
use App\Models\masterApps\departemen;



class pengajuanController extends Controller
{
    public function approval($id){
        $pengajuan      = Pengajuan::findOrFail($id);
        // $filejadwal     = asset("masterApps/import/".$pengajuan->file_attachment);
        $uploadjadwal   = Excel::import( new formImport, public_path('masterApps/import/'.$pengajuan->file_attachment));
        File::delete("public/masterApps/import/".$pengajuan->file_attachment);


        return back();
    }

    public function formBerlaku(){
        return view ('masterApps.form-berlaku');
    }

    public function departemen(){
        $departemen = departemen::all();
        $tampil = Pengajuan::all();
        return view('masterApps.form-berlaku', compact('departemen', 'tampil'));

        
    }

    public function download(){ 

        $file = '';

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, '' , $headers);
    }

    public function dpt($id)
    {
        $departemen = departemen::findOrFail($id);

        foreach($departemen as $key=>$value)
        {

        }
        return $departemen;
        return response()->json([
            'departemen'=> $departemen
        ]);
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
        
        $depart = departemen::all();
        return view ('masterApps.pengajuan', compact('depart'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
        $file  = $request->file('file_attachment')->getClientOriginalName();
        $request->file('file_attachment')->move("public/masterApps/import/",$file);
        $pengajuan = Pengajuan::create([
            'no_perubahan'          => $request->no_perubahan,
            'departemen_id'         => $request->departemen_id,
            'nama_form'             => $request->nama_form,
            'workcenter'            => $request->workcenter,
            'tgl_pengajuan'         => $request->tgl_pengajuan,
            'tgl_berlaku'           => $request->tgl_berlaku,
            'nama_pengaju'          => $request->nama_pengaju,
            'manager_approval'      => $request->manager_approval,
            'kriteria_perubahan'    => $request->kriteria_perubahan, 
            'no_revisi_form'        => $request->no_revisi_form, 
            'file_attachment'       => $file,
        ]);
            
        $pengajuan->email = "luthfeniaaa@gmail.com";
        $pengajuan->notify(new Email($pengajuan));

        return redirect()->route('pengajuan', compact( 'pengajuan'));
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

    public function getJsonData(Request $request)
    {
        $data = Pengajuan::where('departemen_id', $request->departemen_id)->get();
        foreach ($data as $key => $value)
        {
            echo "
                <tr>
                    <td>".$value->no_perubahan."</td>
                    <td>".$value->departemen->departemen."</td>
                    <td>".$value->nama_form."</td>
                    <td>".$value->tgl_pengajuan."</td>
                    <td>".$value->tgl_berlaku."</td>
                    <td>".$value->nama_pengaju."</td>
                    <td>".$value->manager_approval."</td>
                    <td>".$value->kriteria_perubahan."</td>
                    <td>
                        <a href='".asset('masterApps/import/'.$value->file_attachment)."' class='btn btn-primary'>Download Form</a>
                    </td>
                </tr>";
        }
    }
}


