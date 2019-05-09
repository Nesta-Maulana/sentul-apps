<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class kodeSampelPi extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'kode_sampel_filling';
	protected $guarded 		= ['id'];
	
}
