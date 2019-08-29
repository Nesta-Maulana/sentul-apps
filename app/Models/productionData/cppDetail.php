<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class cppDetail extends Model
{
	protected $connection 	= 'production_data';
	protected $table 		= 'cpp_detail';
	protected $guarded 		= ['id'];

	public function palet()
	{
		return $this->hasMany('App\Models\productionData\palet', 'cpp_detail_id','id');
	}
	public function wo()
	{
		return $this->belongsTo('App\Models\productionData\wo', 'wo_id','id');
	}
	public function mesinFilling()
	{
		return $this->belongsTo('App\Models\masterApps\mesinFilling', 'mesin_filling_id','id');
	}
}
