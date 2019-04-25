<?php

namespace App\productionData;

use Illuminate\Database\Eloquent\Model;

class wo extends Model
{
	protected $connection 	= 'mysql3';
	protected $table 		= 'wo';
	protected $guarded 		= ['id'];
}
