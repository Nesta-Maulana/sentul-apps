<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class analisaMikroDetail extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'analisa_mikro';
	protected $guarded 		= ['id'];

	public function analisaMikro()
	{
		return $this->belongsTo('App\Models\productionData\analisaMikro', 'analisa_mikro_id','id');
	}
}
