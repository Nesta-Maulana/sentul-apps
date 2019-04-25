<?php

namespace App\Imports\Penyelia;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\ToModel;
use App\productionData\wo;
use App\Models\masterApps\produk;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class mtolImport implements WithMappedCells,ToModel
{
	use Importable;
	public function mapping(): array
	{
		//mengambil dari row 5 sampai row 50 
		for ($i=5; $i <= 50 ; $i++) 
		{ 
			$return['plan_row_'.$i]							= "B".$i; // INDEX 0 dalam hasil 
			$return['production_plan_date_row_'.$i]			= "C".$i; // INDEX 1 dalam hasil 
			$return['nomor_wo_row_'.$i]						= "D".$i; // INDEX 2 dalam hasil 
			$return['keterangan_1_row_'.$i]					= "F".$i; // INDEX 3 dalam hasil 
			$return['keterangan_2_row_'.$i]					= "G".$i; // INDEX 4 dalam hasil 
			$return['keterangan_3_row_'.$i] 				= "H".$i; // INDEX 5 dalam hasil 
			$return['kode_produk_row_'.$i] 					= "I".$i; // INDEX 6 dalam hasil 
			$return['nama_produk_row_'.$i] 					= "J".$i; // INDEX 7 dalam hasil 	 
			$return['status_row_'.$i] 						= "L".$i; // INDEX 8 dalam hasil 
			$return['revisi_formula_row_'.$i] 				= "Z".$i; // INDEX 9 dalam hasil 
		}
		return $return;
	}
	public function model(array $row)
    {
    	$baris_asli = 1; // untuk deklarasi baris asli yang akan digunakan datanya
    	// pengecekan row 5 sampe 50 
    	for ($i=5; $i <= 50 ; $i++)  
    	{ 
    		$hasil['baris_ke_'.$baris_asli] = array(); // deklarasi baris asli yang akan di ambil sebagai array

    		foreach ($row as $key => $value) // looping semua hasil yang diambil dari row 5 sampe 50
    		{
    			$keynya = explode('_',$key); 
            	$cek = end($keynya); // pengambilan row dari pengambilan data 
    			if ($cek == $i)  // pengecekan apa row data yang di ambil sesuai dengan row yang akan di cek secara ascending 5-50
    			{
    				// apabila sesuai maka akan di cek apa isi baris nomor wo , nama produk , kode produknya tidak kosong 
    				if ($row['nomor_wo_row_'.$i] !== "" && $row['nomor_wo_row_'.$i] !== NULL && $row['nama_produk_row_'.$i] && $row['nama_produk_row_'.$i] !== NULL && $row['kode_produk_row_'.$i] !== "" && $row['kode_produk_row_'.$i] !== NULL) 
    				{
    					// apabila tidak kosong maka akan di masukan sebagai bagian dari baris yang akan di input INDEXING lihat di fungsi mapping diatas
    					array_push($hasil['baris_ke_'.$baris_asli], $value);
    				}
    			}
    		}
    		// pengecekan apabila array dari baris aslinya tidak hanya array kosong maka dia akan menambah baris baru
    		if ($hasil['baris_ke_'.$baris_asli] !== []) 
    		{
	    		$baris_asli++;
    		}
    	}
    	$jadwalinsert 	= array();
    	for ($i=1; $i < count($hasil) ; $i++) 
		{ 
			$arrayrow 					= array();
			$plan 						= 	$hasil['baris_ke_'.$i][0];
			$production_plan_date 		= 	Date::excelToDateTimeObject($hasil['baris_ke_'.$i][1]);
			$nomor_wo 					= 	$hasil['baris_ke_'.$i][2];
			$keterangan_1 				= 	$hasil['baris_ke_'.$i][3];
			$keterangan_2 				= 	$hasil['baris_ke_'.$i][4];
			$keterangan_3 				= 	$hasil['baris_ke_'.$i][5];
			$kode_produk 				= 	$hasil['baris_ke_'.$i][6];
			$nama_produk 				= 	$hasil['baris_ke_'.$i][7];
			$status 					= 	$hasil['baris_ke_'.$i][8];
			$revisi_formula 			= 	$hasil['baris_ke_'.$i][9];
			if (!is_null($plan)) 
			{
				if ($plan == 'PLG') 
				{
					$plan = '3';
				}
			}

			if (!is_null($keterangan_1) || $keterangan_1 == "") 
			{
				$keterangan_1 = "-";
			}
			if (!is_null($keterangan_2) || $keterangan_2 == "") 
			{
				$keterangan_2 = "-";
			}
			if (!is_null($keterangan_3) || $keterangan_3 == "") 
			{
				$keterangan_3 = "-";
			}
			//mengambil data produk dengan 
			if ($kode_produk !== "" && $nama_produk !== "" || !is_null($kode_produk) && !is_null($nama_produk)) 
			{

				$produk 	= produk::where('nama_produk',$nama_produk)->get();
				dd($produk);	
			}
			array_push($arrayrow['plan_id'], $plan);

    	}

    }
}
