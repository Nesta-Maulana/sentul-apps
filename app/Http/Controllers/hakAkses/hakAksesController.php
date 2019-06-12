<?php

namespace App\Http\Controllers\hakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\masterApps\aplikasi;
use Session;

class hakAksesController extends Controller
{
    public function hakAkses(){
        $aplications = aplikasi::all();
        if(!Session::get('login')){
            return back()->with('failed', 'Harap login terlebih dahulu');
        }
        return view('hakAkses.requestHakAkses', ['aplications' => $aplications]);
    }
}
