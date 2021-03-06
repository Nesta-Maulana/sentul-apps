<?php

namespace App\Models\productionData;

use Illuminate\Database\Eloquent\Model;

class wo extends Model
{
	protected $connection 	= 'production_data';
	protected $table 		= 'wo';
	protected $guarded 		= ['id'];
	public function produk()
	{
        return $this->belongsTo('App\Models\masterApps\produk', 'produk_id');
    }
    public function rpdFillingHead()
    {
        return $this->belongsTo('App\Models\productionData\rpdFillingHead', 'rpd_filling_head_id');
    }

    public function rpdFillingDetail()
    {
        return $this->hasMany('App\Models\productionData\rpdFillingDetailPi', 'wo_id','id');
    }
    public function cppHead()
    {
        return $this->belongsTo('App\Models\productionData\cppHead', 'cpp_head_id');
    }
    public function cppDetail()
    {
        return $this->hasMany('App\Models\productionData\cppDetail', 'wo_id','id');
    }
}
