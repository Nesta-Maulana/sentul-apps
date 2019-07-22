<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class ppqfg extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'ppq';
	protected $guarded 		= ['id'];

	public function palet_ppq()
	{
		return $this->hasMany('App\Models\productionData\paletPpq');
	}
}
