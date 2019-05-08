<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class rpdFillingHead extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'rpd_filling_head';
	protected $guarded 		= ['id'];
	public $timestamps 		= true;
	public function wo()
	{
		return $this->hasMany('App\Models\productionData\wo', 'rpd_filling_head_id','id');
	}
}
