<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class cppHead extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'cpp_head';
	protected $guarded 		= ['id'];
	public function wo()
	{
		return $this->hasMany('App\Models\productionData\wo', 'cpp_head_id','id');
	}
	public function cppDetail()
	{
		return $this->hasMany('App\Models\productionData\cppDetail', 'cpp_head_id','id');
	}
}
