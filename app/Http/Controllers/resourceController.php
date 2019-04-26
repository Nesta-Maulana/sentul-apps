<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\userAccess\userAccess;
use App\Models\userAccess\role;
use App\Models\masterApps\hakAkses;
use App\Models\masterApps\menu;
use App\Models\masterApps\hakAksesAplikasi;
use App\Models\masterApps\hakAksesUserAplikasi;
use App\Models\masterApps\aplikasi;
use App\Models\masterApps\karyawan;
use App\Models\masterApps\plan;
use App\Models\masterApps\jenisProduk;
use App\Models\masterApps\produk;
use App\Models\masterApps\brand;
use App\Models\masterApps\subBrand;
use App\Models\masterApps\mesinFilling;
use App\Models\masterApps\mesinFillingHead;
use App\Models\masterApps\mesinFillingDetail;
use App\Models\utilityOnline\kategori;
use App\Models\utilityOnline\bagian;
use App\Models\utilityOnline\workcenter;
use App\Models\utilityOnline\company;
use App\Models\utilityOnline\rasioHead;
use App\Models\utilityOnline\rasio;
use App\Models\utilityOnline\kategoriPencatatan;
use App\Models\utilityOnline\satuan;
use DB;

class resourceController extends Controller
{
	public function enkripsi($string)
	{
		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'sentul-apps';
	    $secret_iv = 'sentul-apps';
	 
	    // hash
	    $key = hash('sha256', $secret_key);
	     
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	 
	    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	    $output = base64_encode($output);
	 
	    return $output;
	}
	public function dekripsi($string)
	{
		 $output = false;
 
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'sentul-apps';
	    $secret_iv = 'sentul-apps';
	 
	    // hash
	    $key = hash('sha256', $secret_key);
	     
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	 
	    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	 
	    return $output;
	}
	public function deleteData($connection, $table, $id){
		if(DB::connection($connection)->table($table)->where('id', $id)->delete() > 0){
			return back()->with('success', 'Berhasil Menghapus');
		}else{
			return back()->with('failed', 'Gagal Menghapus');
		}

	}
}
