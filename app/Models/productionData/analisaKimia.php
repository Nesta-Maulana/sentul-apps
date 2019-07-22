<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class analisaKimia extends Model
{
	protected $connection 	= 'mysql4';
	protected $table 		= 'analisa_kimia';
	protected $guarded 		= ['id'];
	public function cppHead()
	{
		return $this->hasOne('App\Models\productionData\cpp_Head', 'analisa_kimia_id','id');
	}
}
