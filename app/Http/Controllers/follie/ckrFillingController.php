<?php

namespace App\Http\Controllers\follie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\Activity;
use App\Models\masterApps\Detail;
use App\Models\masterApps\Kategoribd;
use App\Models\masterApps\mesinFilling;

class ckrFillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function index()
    {
        $activity = Activity::all();
        $kategori = Kategoribd::all();
        $mesin = mesinFilling::all();
        $detail = Detail::all();

        return view ('follie.ckrfilling', compact('activity', 'kategori', 'mesin', 'detail'));
    }

    public function getfil($id){
        if($id == 31){
            return mesinFilling::whereBetween('id', [1,2])->get();
        }elseif($id == 32){
            return  mesinFilling::where('id',1)->get();
        }else{
            return mesinFilling::whereBetween('id', [1,2])->get();
        }
       
    }

    public function getkategoribd($id,$activity_id){
        return kategoribd::where(['mesin_filling_id' => $id, 'list_activity_id' => $activity_id])->get();
    }

    public function getdetail($id){
        return Detail::where('kategori_bd_id',$id)->get();
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
        
    }
}
