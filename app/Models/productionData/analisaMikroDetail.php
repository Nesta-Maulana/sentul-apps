<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class analisaMikroDetail extends Model
{
	protected $connection 	= 'production_data';
	protected $table 		= 'analisa_mikro_detail';
	protected $guarded 		= ['id'];

	public function analisaMikro()
	{
		return $this->belongsTo('App\Models\productionData\analisaMikro', 'analisa_mikro_id','id');
	}
	public function rpdFillingDetailPi()
	{
		return $this->belongsTo('App\Models\productionData\rpdFillingDetailPi', 'rpd_filling_detail_id','id');
	}
}
