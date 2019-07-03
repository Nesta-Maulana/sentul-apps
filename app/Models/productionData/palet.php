<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class palet extends Model
{

	protected $connection 	= 'mysql4';
	protected $table 		= 'palet';
	protected $guarded 		= ['id'];

	public function cppDetail()
	{
		return $this->belongsTo('App\Models\productionData\cppDetail', 'cpp_detail_id','id');
	}

}
