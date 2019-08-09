<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class analisaMikro extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'analisa_mikro';
	protected $guarded 		= ['id'];
	public function cppHead()
	{
		return $this->belongsTo('App\Models\productionData\cppHead', 'cpp_head_id','id');
	}

	public function analisaMikroResampling()
	{
		return $this->hasMany('App\Models\productionData\analisaMikro', 'analisa_mikro_resampling','id');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\userAccess\userAccess', 'user_inputer_id','id');
	}

	public function analisaMikroDetail()
	{
		return $this->hasMany('App\Models\productionData\analisaMikroDetail', 'analisa_mikro_id','id');
	}
}
