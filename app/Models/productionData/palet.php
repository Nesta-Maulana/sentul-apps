<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class palet extends Model
{

	protected $connection 	= 'mysql4';
	protected $table 		= 'palet';
	protected $guarded 		= ['id'];

}
