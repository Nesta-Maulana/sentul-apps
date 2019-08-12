<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class cppHead extends Model
{
	protected $connection 	= 'production_data';
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
	public function analisaKimia()
	{
		return $this->belongsTo('App\Models\productionData\analisaKimia', 'analisa_kimia_id','id');
	}

	public function analisaMikro()
	{
		return $this->hasOne('App\Models\productionData\analisaMikro', 'cpp_head_id','id');
	}

	public function produk()
	{
		return $this->belongsTo('App\Models\masterApps\produk', 'produk_id','id');
	}
}
