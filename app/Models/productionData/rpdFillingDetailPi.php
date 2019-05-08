<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class rpdFillingDetailPi extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'rpd_filling_head';
	protected $guarded 		= ['id'];
}
