<?php

namespace App\Http\Controllers\rollie;

use Illuminate\Http\Request;
use App\Http\Controllers\resourceController;

class CppController extends resourceController
{
	public function importCpp(Request $request)
	{
		if ($request->cpptype == null) 
		{
			return redirect(route('cpp'))->with('failed', 'Harap Pilih Jenis Cpp Yang Kamu Upload');
		} 
		else 
		{
			if ($request->hasFile('cppfile')) 
			{
				$cpptype = app('App\Http\Controllers\resourceController')->dekripsi($request->cpptype); 
				switch ($cpptype) 
				{
					case 'brix':
						//menentukan sheet mana yang akan di pakai atau digunakan
        				$upload=Excel::import(new cppBrix, $cppfile);
					break;
					case 'prisma':
						dd('disini prisma');
					break;
				}
				
			}
			else
			{
				return redirect(route('cpp'))->with('failed', 'Harap Pilih File Cpp Yang Akan Anda Upload');
			}
		}
		
	}
}
