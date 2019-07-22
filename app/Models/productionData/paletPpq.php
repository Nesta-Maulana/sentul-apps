<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class paletPpq extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'palet_ppq';
	protected $guarded 		= ['id'];
	public function palet()
	{
		return $this->belongsTo('App\Models\productionData\palet');
	}
	public function ppq()
	{
		return $this->belongsTo('App\Models\productionData\ppqfg');
	}
}
