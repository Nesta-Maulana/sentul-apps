<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class cppDetail extends Model
{
	protected $connection 	= 'mysql4';
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
}
