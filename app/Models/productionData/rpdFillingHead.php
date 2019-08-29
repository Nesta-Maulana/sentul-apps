<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class rpdFillingHead extends Model
{
	protected $connection 	= 'production_data';
	protected $table 		= 'rpd_filling_head';
	protected $guarded 		= ['id'];
	public $timestamps 		= true;
	public function wo()
	{
		return $this->hasMany('App\Models\productionData\wo', 'rpd_filling_head_id','id');
	}
	public function detail_pi()
	{
		return $this->hasMany('App\Models\productionData\rpdFillingDetailPi', 'rpd_filling_head_id','id');
	}
	public function detail_at_event()
	{
		return $this->hasMany('App\Models\productionData\rpdFillingDetailAtEvent', 'rpd_filling_head_id','id');
	}
}
