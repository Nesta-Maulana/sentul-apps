<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class rpdFillingDetailPi extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'rpd_filling_detail_pi';
	protected $guarded 		= ['id'];
	public function rpd_head()
	{
		return $this->belongsTo('App\Models\productionData\rpdFillingHead');
	}
	public function kode_sampel()
	{
		return $this->belongsTo('App\Models\productionData\kodeSampelPi');
	}
	public function mesin_filling()
	{
		return $this->belongsTo('App\Models\masterApps\mesinFilling');
	}
	public function wo()
	{
		return $this->belongsTo('App\Models\productionData\wo', 'wo_id','id');
	}
}
